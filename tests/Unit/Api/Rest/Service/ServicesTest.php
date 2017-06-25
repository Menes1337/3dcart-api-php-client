<?php

namespace tests\Unit\Api\Rest\Service;

use tests\Unit\ThreeDCartTestCase;
use ThreeDCart\Api\Rest\Request\RequestInterface;
use ThreeDCart\Api\Rest\Resource\Category;
use ThreeDCart\Api\Rest\Resource\Customer;
use ThreeDCart\Api\Rest\Service\Categories;
use ThreeDCart\Api\Rest\Service\Customers;
use ThreeDCart\Primitive\StringValueObject;

/**
 * @package tests\Unit\Api\Rest\Service
 */
class ServicesTest extends ThreeDCartTestCase
{
    /** @var RequestInterface|\PHPUnit_Framework_MockObject_MockObject */
    private $requestInterfaceMock;
    
    public function setUp()
    {
        $this->requestInterfaceMock = $this->getRequestInterfaceMock();
    }
    
    /**
     * @param string   $expectedObjectClass
     * @param array    $expectedValues
     * @param string   $serviceClass
     * @param string   $serviceMethod
     * @param object[] $methodParameters
     * @param string   $responseJson
     * @param string   $responseObjectFieldName
     *
     * @dataProvider provideServicesAndMethodsForResponseLists
     */
    public function testIsResponseProcessedCorrectForLists(
        $expectedObjectClass,
        $expectedValues,
        $serviceClass,
        $serviceMethod,
        array $methodParameters,
        $responseJson,
        $responseObjectFieldName
    ) {
        $this->requestInterfaceMock->method('send')->willReturn(
            new StringValueObject(
                $responseJson
            )
        );
        
        $subjectUnderTest = new $serviceClass(
            $this->requestInterfaceMock
        );
        
        $generatedObjects = $subjectUnderTest->{$serviceMethod}(
            ...$methodParameters
        );
        
        $this->assertInstanceOf($expectedObjectClass, $generatedObjects[0]);
        $this->assertInstanceOf($expectedObjectClass, $generatedObjects[1]);
        
        $this->assertEquals($expectedValues, [
            $generatedObjects[0]->{$responseObjectFieldName},
            $generatedObjects[1]->{$responseObjectFieldName}
        ]);
    }
    
    /**
     * @return array
     */
    public function provideServicesAndMethodsForResponseLists()
    {
        return [
            'Customer - getCustomers'    => [
                Customer::class,
                [123, 234],
                Customers::class,
                'getCustomers',
                [
                    null,
                    null,
                    null
                ],
                '[{"CustomerID" : 123}, {"CustomerID" : 234}]',
                'CustomerID'
            ],
            'Categories - getCategories' => [
                Category::class,
                [23, 45],
                Categories::class,
                'getCategories',
                [
                    null,
                    null,
                    null
                ],
                '[{"CategoryID" : 23}, {"CategoryID" : 45}]',
                'CategoryID'
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
