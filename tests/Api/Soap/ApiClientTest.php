<?php

namespace tests\Api\Soap;

use tests\ThreeDCartTestCase;
use ThreeDCart\Api\Soap\ApiClient;
use ThreeDCart\Api\Soap\Resources\Customer\Customer;
use ThreeDCart\Api\Soap\Resources\Order\Order;
use ThreeDCart\Api\Soap\Resources\Order\Status;
use ThreeDCart\Api\Soap\Resources\Product\Product;
use ThreeDCart\Api\Soap\ResponseHandlerInterface;

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
        $products = $this->sut->getProducts();
        
        $this->assertEquals(true, is_array($products));
        $this->assertCount(20, $products);
        
        foreach ($products as $product) {
            $this->assertInstanceOf(Product::class, $product);
        }
    }
    
    public function testGetCustomers()
    {
        $this->sut->setSoapClient($this->getSoapClientMock('getCustomer', 'getCustomerResult'));
        $customers = $this->sut->getCustomers();
        
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
        
        $this->assertInstanceOf(Status::class, $orderStatus);
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
    
    public function testGetProductInventory()
    {
        $this->sut->setSoapClient($this->getSoapClientMock('getProductInventory', 'getProductInventoryResult'));
        $productInventory = $this->sut->getProductInventory('Custom Cap');
        
        $this->assertEquals('Custom Cap', $productInventory->getProductID());
        $this->assertEquals('0', $productInventory->getInventory());
    }
    
    public function testGetCustomerLoginToken()
    {
        $this->sut->setSoapClient($this->getSoapClientMock('GetCustomerLoginToken', 'getCustomerLoginTokenResult'));
        $customerLoginToken = $this->sut->getCustomerLoginToken('test@3dcart.com', 1800);
        
        $this->assertEquals('fhWZ2A1EX49XV9Z7dwqUbZsMn/uDrQeEgKZ4ubaHMdwcp2IyRISw789d0beK7+f3',
            $customerLoginToken->getToken());
    }
    
    public function testGetOrders()
    {
        $this->sut->setSoapClient($this->getSoapClientMock('getOrder', 'getOrderResult'));
        $orders = $this->sut->getOrders();
        
        $this->assertEquals(true, is_array($orders));
        $this->assertCount(2, $orders);
        
        foreach ($orders as $order) {
            $this->assertInstanceOf(Order::class, $order);
        }
    }
    
    public function testUpdateProductInventory()
    {
        $this->sut->setSoapClient($this->getSoapClientMock('updateProductInventory', 'updateProductInventoryResult'));
        $success = $this->sut->updateProductInventory(1005, 1000);
        
        $this->assertEquals(true, $success);
    }
    
    public function testUpdateOrderStatus()
    {
        $this->sut->setSoapClient($this->getSoapClientMock('updateOrderStatus', 'updateOrderStatusResult'));
        $success = $this->sut->updateOrderStatus('AB-1000', 'Processing');
        
        $this->assertEquals(true, $success);
    }
    
    public function testUpdateOrderShipment()
    {
        $this->sut->setSoapClient($this->getSoapClientMock('updateOrderShipment', 'updateOrderShipmentResult'));
        $success = $this->sut->updateOrderShipment('AB-1000', '0', '123456789', '2016-11-06');
        
        $this->assertEquals(true, $success);
    }
    
    public function testSetResponseHandler()
    {
        $responseHandlerMock = $this->getMockBuilder(ResponseHandlerInterface::class)->getMock();
        
        $parameter =
            json_decode('{"getCustomerCountResult":{"any":"<CustomerCountResponse xmlns=\"\"><CustomerCount>38<\/CustomerCount><\/CustomerCountResponse>\r\n"}}');
        
        $responseHandlerMock->expects($this->once())->method('processXMLToArray')
                            ->with($parameter->getCustomerCountResult, 'CustomerCount')
        ;
        $this->sut->setSoapClient($this->getSoapClientMock('getCustomerCount', 'getCustomerCountResult'));
        $this->sut->setResponseHandler($responseHandlerMock);
        $this->sut->getCustomerCount();
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
