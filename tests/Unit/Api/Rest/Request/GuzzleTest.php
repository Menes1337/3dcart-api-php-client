<?php

namespace tests\Unit\Api\Rest\Request\Handler;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;
use tests\Unit\ThreeDCartTestCase;
use ThreeDCart\Api\Rest\Authentication\HttpHeader;
use ThreeDCart\Api\Rest\AuthenticationServiceInterface;
use ThreeDCart\Api\Rest\Request\ApiPathAppendix;
use ThreeDCart\Api\Rest\Request\ClientException;
use ThreeDCart\Api\Rest\Request\ConnectException;
use ThreeDCart\Api\Rest\Request\Guzzle;
use ThreeDCart\Api\Rest\Request\HttpMethod;
use ThreeDCart\Api\Rest\Request\HttpParameter;
use ThreeDCart\Api\Rest\Request\HttpParameterList;
use ThreeDCart\Api\Rest\Request\ServerException;
use ThreeDCart\Primitive\StringValueObject;

/**
 * @package tests\Unit\Api\Rest\Request
 */
class GuzzleTest extends ThreeDCartTestCase
{
    /** @var Guzzle */
    private $subjectUnderTest;
    
    /** @var ClientInterface|\PHPUnit_Framework_MockObject_MockObject */
    private $clientInterfaceMock;
    
    /** @var AuthenticationServiceInterface|\PHPUnit_Framework_MockObject_MockObject */
    private $authenticationMock;
    
    public function setUp()
    {
        $this->clientInterfaceMock = $this->getMockBuilder(ClientInterface::class)
                                          ->getMockForAbstractClass();
        $this->clientInterfaceMock->method('request')->willReturn(
            new Response(200, [], 'test')
        );
        $this->authenticationMock = $this->getMockBuilder(AuthenticationServiceInterface::class)
                                         ->getMockForAbstractClass();
        $this->authenticationMock->method('getHttpHeaders')->willReturn(new HttpHeader(array()));
        
        $this->subjectUnderTest = new Guzzle(
            $this->clientInterfaceMock,
            $this->authenticationMock
        );
    }
    
    /**
     * @param array             $expectedGuzzleCallParameter
     * @param HttpMethod        $httpMethod
     * @param ApiPathAppendix   $apiPathAppendix
     * @param HttpParameterList $httpGetParameterList
     * @param HttpParameterList $httpPostParameterList
     *
     * @dataProvider provideRequests
     */
    public function testSendParameters(
        array $expectedGuzzleCallParameter,
        HttpMethod $httpMethod,
        ApiPathAppendix $apiPathAppendix,
        HttpParameterList $httpGetParameterList,
        HttpParameterList $httpPostParameterList
    ) {
        $this->clientInterfaceMock->method('request')->with(
            ...$expectedGuzzleCallParameter
        );
        
        $this->subjectUnderTest->send(
            $httpMethod,
            $apiPathAppendix,
            $httpGetParameterList,
            $httpPostParameterList
        );
    }
    
    public function provideRequests()
    {
        $httpParameterList = new HttpParameterList();
        $httpParameterList->addParameter(
            new HttpParameter(
                new StringValueObject('testKey'),
                new StringValueObject('testValue')
            )
        );
        
        return [
            'default'                             => [
                array(
                    'GET',
                    '',
                    [
                        'headers' => array(),
                        'verify'  => false
                    ]
                ),
                new HttpMethod(HttpMethod::HTTP_METHOD_GET),
                new ApiPathAppendix(''),
                new HttpParameterList(),
                new HttpParameterList()
            ],
            'default with appendix path'          => [
                array(
                    'GET',
                    'test',
                    [
                        'headers' => array(),
                        'verify'  => false
                    ]
                ),
                new HttpMethod(HttpMethod::HTTP_METHOD_GET),
                new ApiPathAppendix('test'),
                new HttpParameterList(),
                new HttpParameterList()
            ],
            'get parameter'                       => [
                array(
                    'GET',
                    '?testKey=testValue',
                    [
                        'headers' => array(),
                        'verify'  => false
                    ]
                ),
                new HttpMethod(HttpMethod::HTTP_METHOD_GET),
                new ApiPathAppendix(''),
                $httpParameterList,
                new HttpParameterList()
            ],
            'get parameter and appendix'          => [
                array(
                    'GET',
                    'test?testKey=testValue',
                    [
                        'headers' => array(),
                        'verify'  => false
                    ]
                ),
                new HttpMethod(HttpMethod::HTTP_METHOD_GET),
                new ApiPathAppendix('test'),
                $httpParameterList,
                new HttpParameterList()
            ],
            'post parameter'                      => [
                array(
                    'GET',
                    '',
                    [
                        'headers'     => array(),
                        'verify'      => false,
                        'form_params' => array(
                            'testKey' => 'testValue'
                        )
                    ]
                ),
                new HttpMethod(HttpMethod::HTTP_METHOD_GET),
                new ApiPathAppendix(''),
                new HttpParameterList(),
                $httpParameterList,
            ],
            'post and get parameter'              => [
                array(
                    'GET',
                    '?testKey=testValue',
                    [
                        'headers'     => array(),
                        'verify'      => false,
                        'form_params' => array(
                            'testKey' => 'testValue'
                        )
                    ]
                ),
                new HttpMethod(HttpMethod::HTTP_METHOD_GET),
                new ApiPathAppendix(''),
                $httpParameterList,
                $httpParameterList,
            ],
            'post and get parameter and appendix' => [
                array(
                    'GET',
                    'test?testKey=testValue',
                    [
                        'headers'     => array(),
                        'verify'      => false,
                        'form_params' => array(
                            'testKey' => 'testValue'
                        )
                    ]
                ),
                new HttpMethod(HttpMethod::HTTP_METHOD_GET),
                new ApiPathAppendix('test'),
                $httpParameterList,
                $httpParameterList,
            ],
        ];
    }
    
    public function testSendConnectException()
    {
        /** @var RequestInterface $requestInterface */
        $requestInterface = $this->getMockBuilder(RequestInterface::class)
                                 ->getMockForAbstractClass();
        $this->clientInterfaceMock->method('request')
                                  ->will($this->throwException(
                                      new \GuzzleHttp\Exception\ConnectException(
                                          'test',
                                          $requestInterface
                                      )
                                  ));
        
        $this->expectException(ConnectException::class);
        $this->subjectUnderTest->send(
            new HttpMethod(HttpMethod::HTTP_METHOD_GET),
            new ApiPathAppendix(''),
            new HttpParameterList(),
            new HttpParameterList());
    }
    
    public function testSendClientException()
    {
        /** @var RequestInterface $requestInterface */
        $requestInterface = $this->getMockBuilder(RequestInterface::class)
                                 ->getMockForAbstractClass();
        $this->clientInterfaceMock->method('request')
                                  ->will($this->throwException(
                                      new \GuzzleHttp\Exception\ClientException(
                                          'test',
                                          $requestInterface
                                      )
                                  ));
        
        $this->expectException(ClientException::class);
        $this->subjectUnderTest->send(
            new HttpMethod(HttpMethod::HTTP_METHOD_GET),
            new ApiPathAppendix(''),
            new HttpParameterList(),
            new HttpParameterList());
    }
    
    public function testSendServerException()
    {
        /** @var RequestInterface $requestInterface */
        $requestInterface = $this->getMockBuilder(RequestInterface::class)
                                 ->getMockForAbstractClass();
        $this->clientInterfaceMock->method('request')
                                  ->will($this->throwException(
                                      new \GuzzleHttp\Exception\ServerException(
                                          'test',
                                          $requestInterface
                                      )
                                  ));
        
        $this->expectException(ServerException::class);
        $this->subjectUnderTest->send(
            new HttpMethod(HttpMethod::HTTP_METHOD_GET),
            new ApiPathAppendix(''),
            new HttpParameterList(),
            new HttpParameterList());
    }
}
