<?php

namespace tests\Unit\Api\Rest\Request\Handler;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;
use tests\Unit\ThreeDCartTestCase;
use ThreeDCart\Api\Rest\Authentication\HttpHeader;
use ThreeDCart\Api\Rest\AuthenticationServiceInterface;
use ThreeDCart\Api\Rest\Request\ApiPathAppendix;
use ThreeDCart\Api\Rest\Request\Handler\Guzzle;
use ThreeDCart\Api\Rest\Request\HandlerInterface;
use ThreeDCart\Api\Rest\Request\HttpMethod;
use ThreeDCart\Api\Rest\Request\HttpParameter;
use ThreeDCart\Api\Rest\Request\HttpParameterList;
use ThreeDCart\Primitive\StringValueObject;

/**
 * @package tests\Unit\Api\Rest\Request
 */
class GuzzleTest extends ThreeDCartTestCase
{
    /**
     * @param array             $expectedGuzzleCallParameter
     * @param HttpMethod        $httpMethod
     * @param ApiPathAppendix   $apiPathAppendix
     * @param HttpParameterList $httpGetParameterList
     * @param HttpParameterList $httpPostParameterList
     *
     * @dataProvider provideRequests
     */
    public function testRequest(
        array $expectedGuzzleCallParameter,
        HttpMethod $httpMethod,
        ApiPathAppendix $apiPathAppendix,
        HttpParameterList $httpGetParameterList,
        HttpParameterList $httpPostParameterList
    ) {
        $clientMock = $this->getClientMock();
        
        $clientMock->expects($this->once())->method('request')->with(
            ...$expectedGuzzleCallParameter
        );
        
        /** @var HandlerInterface | \PHPUnit_Framework_MockObject_MockObject $subjectUnderTest */
        $subjectUnderTest = $this->getMockBuilder(Guzzle::class)
                                 ->setMethods(null)
                                 ->setConstructorArgs(
                                     [
                                         $clientMock,
                                         $this->getAuthenticationMock()
                                     ]
                                 )->getMock();
        
        $subjectUnderTest->request(
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
            'default'                    => [
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
            'default with appendix path' => [
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
            'get parameter'              => [
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
            'get parameter and appendix' => [
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
            'post parameter'             => [
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
            'post and get parameter'             => [
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
            'post and get parameter and appendix'             => [
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
    
    /**
     * @return AuthenticationServiceInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private function getAuthenticationMock()
    {
        $authenticationMock = $this->getMockBuilder(AuthenticationServiceInterface::class)->getMock();
        
        $authenticationMock->method('getHttpHeaders')->willReturn(new HttpHeader(array()));
        
        return $authenticationMock;
    }
    
    /**
     * @return ClientInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private function getClientMock()
    {
        $clientMock = $this->getMockBuilder(Client::class)
                           ->setMethods(array('request'))
                           ->getMock();
        
        $clientMock->method('request')->willReturn(
            new Response(200, [], 'test')
        );
        
        return $clientMock;
    }
}
