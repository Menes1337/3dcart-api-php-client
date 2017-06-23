<?php

namespace tests\Unit\Api\Rest\Service;

use tests\Unit\ThreeDCartTestCase;
use ThreeDCart\Api\Rest\Request\RequestInterface;
use ThreeDCart\Api\Rest\Service\Customers;
use ThreeDCart\Primitive\StringValueObject;

/**
 * Class CustomersTest
 *
 * @package tests\Unit\Api\Rest\Service
 */
class CustomersTest extends ThreeDCartTestCase
{
    public function testGetCustomers()
    {
        $subjectUnderTest = $this->getCustomersServiceMock(
            $this->loadMock(
                'getCustomers',
                'response.json'
            )
        );
        
        $this->assertEquals(true, is_string($subjectUnderTest->getCustomers()->getStringValue()));
    }
    
    public function testGetCustomer()
    {
        $subjectUnderTest = $this->getCustomersServiceMock(
            $this->loadMock(
                'getCustomer',
                'response.json'
            )
        );
        $test             = $subjectUnderTest->getCustomers()->getStringValue();
        $this->assertEquals(true, is_string($test));
    }
    
    /**
     * @param string $expectedResponse
     *
     * @return Customers
     */
    private function getCustomersServiceMock($expectedResponse)
    {
        $handlerMock = $this->getHandlerMock();
        
        $handlerMock->method('send')->willReturn(
            new StringValueObject(
                $expectedResponse
            )
        );
        
        return new Customers($handlerMock);
    }
    
    /**
     * @return RequestInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private function getHandlerMock()
    {
        return $this->getMockBuilder(RequestInterface::class)->getMock();
    }
}
