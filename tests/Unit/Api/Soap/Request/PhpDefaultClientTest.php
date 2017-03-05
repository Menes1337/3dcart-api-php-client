<?php

namespace tests\Unit\Api\Soap;

use tests\Unit\ThreeDCartTestCase;
use ThreeDCart\Api\Soap\Request\PhpDefaultClient;
use ThreeDCart\Api\Soap\Request\ResponseBodyEmptyException;
use ThreeDCart\Api\Soap\Request\ResponseHandler;
use ThreeDCart\Api\Soap\Request\Xml\SimpleXmlExceptionRenderer;
use ThreeDCart\Primitive\StringValueObject;

class PhpDefaultClientTest extends ThreeDCartTestCase
{
    /** @var PhpDefaultClient */
    private $subjectUnderTest;
    
    public function setup()
    {
        $this->subjectUnderTest = $this->getMockBuilder(PhpDefaultClient::class)
                                       ->setMethods(null)
                                       ->setConstructorArgs(array(
                                           $this->getMockFromWsdl($this->getRootPath() . 'soap-api'
                                               . DIRECTORY_SEPARATOR . 'wsdl' . DIRECTORY_SEPARATOR . 'api.wsdl'),
                                           new ResponseHandler(new SimpleXmlExceptionRenderer()),
                                           new StringValueObject(''),
                                           new StringValueObject(''),
                                       ))
                                       ->getMock()
        ;
    }
    
    /**
     * @param string $method
     * @param string $soapMethodName
     * @param array  $parameters
     *
     * @dataProvider provideMethods
     */
    public function testEmptyRequest($method, $soapMethodName, $parameters)
    {
        $this->subjectUnderTest->setSoapClient($this->getSoapClientEmptyResponse($soapMethodName));
        
        $this->expectException(ResponseBodyEmptyException::class);
        call_user_func_array(array($this->subjectUnderTest, $method), $parameters);
    }
    
    /**
     * @return array
     */
    public function provideMethods()
    {
        return [
            ['getProduct', 'getProduct', array(100, 1, '', '')],
            ['getCustomers', 'getCustomer', array(100, 1, '', '')],
            ['getOrderStatus', 'getOrderStatus', array(123, '')],
            ['getProductCount', 'getProductCount', array('')],
            ['getProductInventory', 'getProductInventory', array(123, '')],
            ['getCustomerLoginToken', 'getCustomerLoginToken', array('test@test.com', 86400, '')],
            ['getCustomerCount', 'getCustomerCount', array('')],
            ['getOrderCount', 'getOrderCount', array(true, '', '', '', '', '')],
            ['getOrders', 'getOrder', array(200, 100, true, '', '', '', '', '')],
            ['updateProductInventory', 'updateProductInventory', array('1234', 3, true, '')],
            ['updateOrderStatus', 'updateOrderStatus', array('123', 'new status', '')],
            ['updateOrderShipment', 'updateOrderShipment', array('1234', 'shipmentid', 'tracking', 'shipmentdate', '')],
            ['editCustomer', 'editCustomer', array('', '', '')],
        ];
    }
    
    /**
     * @param string $method
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|\SoapClient
     */
    private function getSoapClientEmptyResponse($method)
    {
        $soapClientMock = $this->getSoapClient();
        $soapClientMock->method($method)->willReturn(new \stdClass());
        
        return $soapClientMock;
    }
    
    /**
     * @return \PHPUnit_Framework_MockObject_MockObject | \SoapClient
     */
    private function getSoapClient()
    {
        $soapClientMock = $this->getMockFromWsdl($this->getRootPath() . 'soap-api'
            . DIRECTORY_SEPARATOR . 'wsdl' . DIRECTORY_SEPARATOR . 'api.wsdl');
        
        return $soapClientMock;
    }
}
