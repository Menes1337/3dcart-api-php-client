<?php

namespace tests\Unit\Api\Rest\Service;

use tests\Unit\ThreeDCartTestCase;
use ThreeDCart\Api\Rest\Filter\CustomerInterface;
use ThreeDCart\Api\Rest\Request\ApiPathAppendix;
use ThreeDCart\Api\Rest\Request\HttpMethod;
use ThreeDCart\Api\Rest\Request\HttpParameter;
use ThreeDCart\Api\Rest\Request\HttpParameterList;
use ThreeDCart\Api\Rest\Request\RequestInterface;
use ThreeDCart\Api\Rest\Select\SelectInterface;
use ThreeDCart\Api\Rest\Service\Customers;
use ThreeDCart\Api\Rest\Sort\SortInterface;
use ThreeDCart\Primitive\BooleanValueObject;
use ThreeDCart\Primitive\StringValueObject;

/**
 * @package tests\Unit\Api\Rest\Service
 */
class CustomersTest extends ThreeDCartTestCase
{
    /** @var Customers */
    private $subjectUnderTest;
    /** @var RequestInterface|\PHPUnit_Framework_MockObject_MockObject */
    private $requestInterfaceMock;
    
    public function setUp()
    {
        $this->requestInterfaceMock = $this->getRequestInterfaceMock();
        $this->subjectUnderTest     = new Customers(
            $this->requestInterfaceMock
        );
    }
    
    /**
     * @param array             $expectedParameterList
     * @param SelectInterface   $selectInterface
     * @param CustomerInterface $customerInterface
     * @param SortInterface     $sortInterface
     *
     * @dataProvider provideGetCustomerParameter
     */
    public function testGetCustomer(
        array $expectedParameterList,
        SelectInterface $selectInterface = null,
        CustomerInterface $customerInterface = null,
        SortInterface $sortInterface = null
    ) {
        $this->requestInterfaceMock->method('send')->willReturn(
            new StringValueObject(
                'test'
            )
        );
        
        $this->requestInterfaceMock->method('send')->with(
            ...$expectedParameterList
        );
        
        $this->assertEquals(
            new StringValueObject('test'),
            $this->subjectUnderTest->getCustomers(
                $selectInterface,
                $customerInterface,
                $sortInterface
            ));
    }
    
    /**
     * @return array
     */
    public function provideGetCustomerParameter()
    {
        $sortInterfaceMock = $this->getMockBuilder(SortInterface::class)->getMockForAbstractClass();
        $sortInterfaceMock->method('isEmpty')->willReturn(
            new BooleanValueObject(false)
        );
        $sortInterfaceMock->method('getQueryString')->willReturn(
            new StringValueObject('test asc,test2 desc')
        );
        
        $selectInterfaceMock = $this->getMockBuilder(SelectInterface::class)->getMockForAbstractClass();
        $selectInterfaceMock->method('isEmpty')->willReturn(
            new BooleanValueObject(false)
        );
        $selectInterfaceMock->method('getQueryString')->willReturn(
            new StringValueObject('test,test2')
        );
        
        $customerFilterInterfaceMock = $this->getMockBuilder(CustomerInterface::class)->getMockForAbstractClass();
        $customerFilterInterfaceMock->method('getHttpParameterList')->willReturn(
            new HttpParameterList([
                    new HttpParameter(
                        new StringValueObject('key'),
                        new StringValueObject('value')
                    )
                ]
            )
        );
        
        return [
            'default parameter'              => [
                [
                    new HttpMethod(HttpMethod::HTTP_METHOD_GET),
                    new ApiPathAppendix(''),
                    new HttpParameterList(),
                    new HttpParameterList()
                ],
                null,
                null,
                null
            ],
            'select parameter only'          => [
                [
                    new HttpMethod(HttpMethod::HTTP_METHOD_GET),
                    new ApiPathAppendix(''),
                    new HttpParameterList(
                        [
                            new HttpParameter(
                                new StringValueObject('$select'),
                                new StringValueObject('test,test2')
                            )
                        ]
                    ),
                    new HttpParameterList()
                ],
                clone $selectInterfaceMock,
                null,
                null
            ],
            'sort parameter only'            => [
                [
                    new HttpMethod(HttpMethod::HTTP_METHOD_GET),
                    new ApiPathAppendix(''),
                    new HttpParameterList(
                        [
                            new HttpParameter(
                                new StringValueObject('$orderby'),
                                new StringValueObject('test asc,test2 desc')
                            )
                        ]
                    ),
                    new HttpParameterList()
                ],
                null,
                null,
                clone $sortInterfaceMock
            ],
            'customer filter parameter only' => [
                [
                    new HttpMethod(HttpMethod::HTTP_METHOD_GET),
                    new ApiPathAppendix(''),
                    new HttpParameterList(
                        [
                            new HttpParameter(
                                new StringValueObject('key'),
                                new StringValueObject('value')
                            )
                        ]
                    ),
                    new HttpParameterList()
                ],
                null,
                clone $customerFilterInterfaceMock,
                null
            ],
            'all parameters are set'         => [
                [
                    new HttpMethod(HttpMethod::HTTP_METHOD_GET),
                    new ApiPathAppendix(''),
                    new HttpParameterList(
                        [
                            new HttpParameter(
                                new StringValueObject('key'),
                                new StringValueObject('value')
                            ),
                            new HttpParameter(
                                new StringValueObject('$orderby'),
                                new StringValueObject('test asc,test2 desc')
                            ),
                            new HttpParameter(
                                new StringValueObject('$select'),
                                new StringValueObject('test,test2')
                            )
                        ]
                    ),
                    new HttpParameterList()
                ],
                clone $selectInterfaceMock,
                clone $customerFilterInterfaceMock,
                clone $sortInterfaceMock
            ],
        ];
    }
    
    /**
     * @return RequestInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private function getRequestInterfaceMock()
    {
        return $this->getMockBuilder(RequestInterface::class)->getMockForAbstractClass();
    }
}
