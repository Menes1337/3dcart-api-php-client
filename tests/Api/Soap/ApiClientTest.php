<?php

namespace tests\Api\Soap;

use tests\ThreeDCartTestCase;
use ThreeDCart\Api\Soap\ApiClient;
use ThreeDCart\Api\Soap\Resources\Customer\Customer;
use ThreeDCart\Api\Soap\Resources\Order\OrderStatus;
use ThreeDCart\Api\Soap\Resources\Product\Product;

class ApiClientTest extends ThreeDCartTestCase
{
    /** @var ApiClient */
    private $sut;
    
    public function setup()
    {
        $this->sut = $this->getMockBuilder(ApiClient::class)
                          ->setMethods(array('__construct'))
                          ->setConstructorArgs(array('', ''))
                          ->getMock()
        ;
    }
    
    public function testGetProducts()
    {
        $this->sut->setSoapClient($this->getSoapClientMock('getProduct', 'getProductResult'));
        $products = $this->sut->getProduct();
        
        $this->assertEquals(true, is_array($products));
        $this->assertCount(20, $products);
        
        foreach ($products as $product) {
            $this->assertInstanceOf(Product::class, $product);
        }
    }
    
    public function testGetCustomers()
    {
        $this->sut->setSoapClient($this->getSoapClientMock('getCustomer', 'getCustomerResult'));
        $customers = $this->sut->getCustomer();
        
        $this->assertEquals(true, is_array($customers));
        $this->assertCount(2, $customers);
        
        foreach ($customers as $customer) {
            $this->assertInstanceOf(Customer::class, $customer);
        }
    }
    
    public function testGetOrderStatus()
    {
        $this->sut->setSoapClient($this->getSoapClientMock('getOrderStatus', 'getOrderStatusResult'));
        $orderStatus = $this->sut->getOrderStatus('AB-1347');
        
        $this->assertInstanceOf(OrderStatus::class, $orderStatus);
        $this->assertEquals('New', $orderStatus->getStatusText());
        $this->assertEquals('1', $orderStatus->getId());
        $this->assertEquals('AB-1347', $orderStatus->getInvoiceNum());
    }
    
    
    public function testGetProductCount()
    {
        $this->sut->setSoapClient($this->getSoapClientMock('getProductCount', 'getProductCountResult'));
        $productsCount = $this->sut->getProductCount();
        
        $this->assertEquals(20, $productsCount);
    }
    
    public function testGetCustomerCount()
    {
        $this->sut->setSoapClient($this->getSoapClientMock('getCustomerCount', 'getCustomerCountResult'));
        $customerCount = $this->sut->getCustomerCount();
        
        $this->assertEquals(38, $customerCount);
    }
    
    public function testGetOrderCount()
    {
        $this->sut->setSoapClient($this->getSoapClientMock('getOrderCount', 'getOrderCountResult'));
        $orderCount = $this->sut->getOrderCount();
        
        $this->assertEquals(311, $orderCount);
    }
    
    /**
     * @param string $method
     * @param string $responseField
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getSoapClientMock($method, $responseField)
    {
        $soapClientMock = $this->getMockBuilder(\SoapClient::class)
                               ->disableOriginalConstructor()
                               ->setMethods(array($method))->getMock()
        ;
        $soapClientMock->method($method)->willReturn($this->getResponseMock($responseField, $method));
        
        return $soapClientMock;
    }
    
    /**
     * @param string $responseField
     * @param string $method
     *
     * @return \stdClass
     */
    private function getResponseMock($responseField, $method)
    {
        $response                        = new \stdClass();
        $response->{$responseField}      = new \stdClass();
        $response->{$responseField}->any = $this->loadMock($method, 'response.xml');
        
        return $response;
    }
}
