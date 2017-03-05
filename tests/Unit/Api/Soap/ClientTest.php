<?php

namespace tests\Unit\Api\Soap;

use tests\Unit\ThreeDCartTestCase;
use ThreeDCart\Api\Soap\Client;
use ThreeDCart\Api\Soap\Request\ClientInterface;
use ThreeDCart\Api\Soap\Resource\Customer\Address;
use ThreeDCart\Api\Soap\Resource\Customer\Customer;
use ThreeDCart\Api\Soap\Resource\Order\AffiliateInformation;
use ThreeDCart\Api\Soap\Resource\Order\CheckoutQuestion;
use ThreeDCart\Api\Soap\Resource\Order\Comments;
use ThreeDCart\Api\Soap\Resource\Order\GiftCertificatePurchased;
use ThreeDCart\Api\Soap\Resource\Order\GiftCertificateUsed;
use ThreeDCart\Api\Soap\Resource\Order\Item;
use ThreeDCart\Api\Soap\Resource\Order\Order;
use ThreeDCart\Api\Soap\Resource\Order\Promotion;
use ThreeDCart\Api\Soap\Resource\Order\Shipment;
use ThreeDCart\Api\Soap\Resource\Order\ShippingInformation;
use ThreeDCart\Api\Soap\Resource\Order\Status;
use ThreeDCart\Api\Soap\Resource\Order\Transaction;
use ThreeDCart\Api\Soap\Resource\Product\Product;
use ThreeDCart\Api\Soap\Resource\ResourceParser;
use ThreeDCart\Api\Soap\Request\ResponseHandler;
use ThreeDCart\Api\Soap\Request\Xml\SimpleXmlExceptionRenderer;
use ThreeDCart\Api\Soap\Response\Xml;
use ThreeDCart\Primitive\StringValueObject;

class ClientTest extends ThreeDCartTestCase
{
    /** @var Client */
    private $subjectUnderTest;
    
    public function setup()
    {
        $this->subjectUnderTest = $this->getMockBuilder(Client::class)
                                       ->setMethods(null)
                                       ->setConstructorArgs(array(
                                           $this->getMockForAbstractClass(ClientInterface::class),
                                           new ResponseHandler(new SimpleXmlExceptionRenderer()),
                                           new ResourceParser()
                                       ))
                                       ->getMock()
        ;
    }
    
    public function testGetProducts()
    {
        $this->subjectUnderTest->setSoapClient($this->getSoapClientMock('getProduct'));
        $products = $this->subjectUnderTest->getProducts();
        
        $this->assertEquals(true, is_array($products));
        $this->assertCount(20, $products);
        
        foreach ($products as $product) {
            $this->assertInstanceOf(Product::class, $product);
        }
    }
    
    public function testGetCustomers()
    {
        $this->subjectUnderTest->setSoapClient($this->getSoapClientMock('getCustomers'));
        $customers = $this->subjectUnderTest->getCustomers();
        
        $this->assertEquals(true, is_array($customers));
        $this->assertCount(2, $customers);
        
        foreach ($customers as $customer) {
            $this->assertInstanceOf(Customer::class, $customer);
        }
    }
    
    public function testGetOrderStatus()
    {
        $this->subjectUnderTest->setSoapClient($this->getSoapClientMock('getOrderStatus'));
        $orderStatus = $this->subjectUnderTest->getOrderStatus('AB-1347');
        
        $this->assertInstanceOf(Status::class, $orderStatus);
        $this->assertEquals('New', $orderStatus->getStatusText());
        $this->assertEquals('1', $orderStatus->getId());
        $this->assertEquals('AB-1347', $orderStatus->getInvoiceNum());
    }
    
    public function testGetProductCount()
    {
        $this->subjectUnderTest->setSoapClient($this->getSoapClientMock('getProductCount'));
        $productsCount = $this->subjectUnderTest->getProductCount();
        
        $this->assertEquals(20, $productsCount->getValue());
    }
    
    public function testGetCustomerCount()
    {
        $this->subjectUnderTest->setSoapClient($this->getSoapClientMock('getCustomerCount'));
        $customerCount = $this->subjectUnderTest->getCustomerCount();
        
        $this->assertEquals(38, $customerCount->getValue());
    }
    
    public function testGetOrderCount()
    {
        $this->subjectUnderTest->setSoapClient($this->getSoapClientMock('getOrderCount'));
        $orderCount = $this->subjectUnderTest->getOrderCount();
        
        $this->assertEquals(311, $orderCount->getValue());
    }
    
    public function testGetProductInventory()
    {
        $this->subjectUnderTest->setSoapClient($this->getSoapClientMock('getProductInventory'));
        $productInventory = $this->subjectUnderTest->getProductInventory('Custom Cap');
        
        $this->assertEquals('Custom Cap', $productInventory->getProductID());
        $this->assertEquals('0', $productInventory->getInventory());
    }
    
    public function testGetCustomerLoginToken()
    {
        $this->subjectUnderTest->setSoapClient($this->getSoapClientMock('GetCustomerLoginToken'));
        $customerLoginToken = $this->subjectUnderTest->getCustomerLoginToken('test@3dcart.com', 1800);
        
        $this->assertEquals('fhWZ2A1EX49XV9Z7dwqUbZsMn/uDrQeEgKZ4ubaHMdwcp2IyRISw789d0beK7+f3',
            $customerLoginToken->getToken());
    }
    
    public function testGetOrders()
    {
        $this->subjectUnderTest->setSoapClient($this->getSoapClientMock('getOrders'));
        $orders = $this->subjectUnderTest->getOrders();
        
        $this->assertEquals(true, is_array($orders));
        $this->assertCount(2, $orders);
        
        foreach ($orders as $order) {
            $this->assertInstanceOf(Order::class, $order);
        }
        
        $firstOrder = $orders[0];
        
        $this->assertEquals($firstOrder->getOrderID(), '1');
        $this->assertEquals($firstOrder->getInvoiceNumber(), 'AB-1000');
        $this->assertEquals($firstOrder->getCustomerID(), '1');
        $this->assertEquals($firstOrder->getDate(), '6/22/2009');
        $this->assertEquals($firstOrder->getTotal(), '1');
        $this->assertEquals($firstOrder->getTax(), '0.00');
        $this->assertEquals($firstOrder->getTax2(), '1.00');
        $this->assertEquals($firstOrder->getTax3(), '2.00');
        $this->assertEquals($firstOrder->getShipping(), '5.99');
        
        $this->assertInstanceOf(Address::class, $firstOrder->getBillingAddress());
        $this->assertEquals($firstOrder->getBillingAddress()->getFirstName(), 'Max');
        $this->assertEquals($firstOrder->getBillingAddress()->getLastName(), 'Mustermann');
        $this->assertEquals($firstOrder->getBillingAddress()->getEmail(), 'test@3dcart.com');
        $this->assertEquals($firstOrder->getBillingAddress()->getAddress(), '123 Street');
        $this->assertEquals($firstOrder->getBillingAddress()->getAddress2(), null);
        $this->assertEquals($firstOrder->getBillingAddress()->getCity(), 'Coral Springs');
        $this->assertEquals($firstOrder->getBillingAddress()->getZipCode(), '33065');
        $this->assertEquals($firstOrder->getBillingAddress()->getStateCode(), 'FL');
        $this->assertEquals($firstOrder->getBillingAddress()->getCountryCode(), 'US');
        $this->assertEquals($firstOrder->getBillingAddress()->getPhone(), '800-828-6650');
        $this->assertEquals($firstOrder->getBillingAddress()->getCompany(), null);
        
        $this->assertInstanceOf(Comments::class, $firstOrder->getComments());
        $this->assertEquals($firstOrder->getComments()->getOrderComment(), 'Sample Order from 3dcart');
        $this->assertEquals($firstOrder->getComments()->getOrderInternalComment(), null);
        $this->assertEquals($firstOrder->getComments()->getOrderExternalComment(), null);
        
        $this->assertEquals($firstOrder->getPaymentMethod(), 'Online Credit Card');
        $this->assertEquals($firstOrder->getCardType(), null);
        $this->assertEquals($firstOrder->getTime(), '12: 44:37 PM');
        
        $this->assertInstanceOf(Transaction::class, $firstOrder->getTransaction());
        $this->assertEquals($firstOrder->getTransaction()->getCVV2(), null);
        $this->assertEquals($firstOrder->getTransaction()->getResponseText(), null);
        $this->assertEquals($firstOrder->getTransaction()->getAVS(), null);
        $this->assertEquals($firstOrder->getTransaction()->getTransactionId(), null);
        $this->assertEquals($firstOrder->getTransaction()->getApprovalCode(), null);
        $this->assertEquals($firstOrder->getTransaction()->getTransactionType(), 'Sale');
        $this->assertEquals($firstOrder->getTransaction()->getAmount(), '11.23');
        
        $this->assertEquals($firstOrder->getDiscount(), '3.33');
        
        $this->assertEquals(true, is_array($firstOrder->getPromotions()));
        foreach ($firstOrder->getPromotions() as $promotion) {
            $this->assertInstanceOf(Promotion::class, $promotion);
        }
        
        /** @var Promotion $firstPromotion */
        $firstPromotion = current($firstOrder->getPromotions());
        $this->assertEquals($firstPromotion->getAmount(), '0.30');
        $this->assertEquals($firstPromotion->getCode(), '1% Shop renegrade Promo');
        
        $this->assertInstanceOf(GiftCertificatePurchased::class, $firstOrder->getGiftCertificatePurchased());
        $this->assertEquals($firstOrder->getGiftCertificatePurchased()->getCode(), 'GC0518136');
        $this->assertEquals($firstOrder->getGiftCertificatePurchased()->getAmount(), '1350.99');
        $this->assertEquals($firstOrder->getGiftCertificatePurchased()->getToName(), 'You');
        $this->assertEquals($firstOrder->getGiftCertificatePurchased()->getToEmail(), 'test@3dcart.com');
        $this->assertEquals($firstOrder->getGiftCertificatePurchased()->getToMessage(),
            '##test order message for gift');
        $this->assertEquals($firstOrder->getGiftCertificatePurchased()->getFromName(), 'Me');
        
        $this->assertInstanceOf(GiftCertificateUsed::class, $firstOrder->getGiftCertificateUsed());
        $this->assertEquals($firstOrder->getGiftCertificateUsed()->getCode(), 'gc0518136');
        $this->assertEquals($firstOrder->getGiftCertificateUsed()->getAmount(), '44.03');
        
        $this->assertEquals($firstOrder->getOrderStatus(), 'New');
        $this->assertEquals($firstOrder->getReferer(), 'http: //www.google.com');
        $this->assertEquals($firstOrder->getSalesPerson(), 'Administrator');
        $this->assertEquals($firstOrder->getIP(), '84.246.249.226');
        $this->assertEquals($firstOrder->getDateStarted(), '6/22/2009 10:23:09 AM');
        $this->assertEquals($firstOrder->getUserID(), 'API');
        $this->assertEquals($firstOrder->getLastUpdate(), '6/22/2009');
        $this->assertEquals($firstOrder->getWeight(), '1.00');
        
        $this->assertInstanceOf(AffiliateInformation::class, $firstOrder->getAffiliateInformation());
        $this->assertEquals($firstOrder->getAffiliateInformation()->getAffiliateID(), '1234');
        $this->assertEquals($firstOrder->getAffiliateInformation()->getAffiliateCommission(), '2.54');
        $this->assertEquals($firstOrder->getAffiliateInformation()->getAffiliateApprovedreason(), null);
        $this->assertEquals($firstOrder->getAffiliateInformation()->isAffiliateApproved(), null);
        
        $this->assertInstanceOf(ShippingInformation::class, $firstOrder->getShippingInformation());
        $this->assertInstanceOf(Shipment::class, $firstOrder->getShippingInformation()->getShipment());
        
        $this->assertEquals($firstOrder->getShippingInformation()->getShipment()->getShipmentID(), '12');
        $this->assertEquals($firstOrder->getShippingInformation()->getShipment()->getShipmentDate(), null);
        $this->assertEquals($firstOrder->getShippingInformation()->getShipment()->getShipping(), '3.56');
        $this->assertEquals($firstOrder->getShippingInformation()->getShipment()->getMethod(), 'Free Shipping');
        $this->assertEquals($firstOrder->getShippingInformation()->getShipment()->getFirstName(), 'First Name');
        $this->assertEquals($firstOrder->getShippingInformation()->getShipment()->getLastName(), 'Last Name');
        $this->assertEquals($firstOrder->getShippingInformation()->getShipment()->getCompany(), null);
        $this->assertEquals($firstOrder->getShippingInformation()->getShipment()->getAddress(), '123 Street');
        $this->assertEquals($firstOrder->getShippingInformation()->getShipment()->getAddress2(), null);
        $this->assertEquals($firstOrder->getShippingInformation()->getShipment()->getCity(), 'Coral Springs');
        $this->assertEquals($firstOrder->getShippingInformation()->getShipment()->getZipCode(), '33065');
        $this->assertEquals($firstOrder->getShippingInformation()->getShipment()->getStateCode(), 'FL');
        $this->assertEquals($firstOrder->getShippingInformation()->getShipment()->getCountryCode(), 'US');
        $this->assertEquals($firstOrder->getShippingInformation()->getShipment()->getPhone(), '800-828-6650');
        $this->assertEquals($firstOrder->getShippingInformation()->getShipment()->getWeight(), '1.00');
        $this->assertEquals($firstOrder->getShippingInformation()->getShipment()->getStatus(), 'New');
        $this->assertEquals($firstOrder->getShippingInformation()->getShipment()->getInternalComment(), 'test comment');
        $this->assertEquals($firstOrder->getShippingInformation()->getShipment()->getTrackingCode(), null);
        
        $this->assertEquals(true, is_array($firstOrder->getShippingInformation()->getOrderItems()));
        
        /** @var Item $firstOrderItem */
        $firstOrderItem = current($firstOrder->getShippingInformation()->getOrderItems());
        
        $this->assertInstanceOf(Item::class, $firstOrderItem);
        $this->assertEquals($firstOrderItem->getShipmentID(), '12');
        $this->assertEquals($firstOrderItem->getProductID(), '1003K');
        $this->assertEquals($firstOrderItem->getProductName(), 'Tote Bag Color: Khaki');
        $this->assertEquals($firstOrderItem->getQuantity(), '1');
        $this->assertEquals($firstOrderItem->getUnitPrice(), '1.00');
        $this->assertEquals($firstOrderItem->getUnitCost(), '0.49');
        $this->assertEquals($firstOrderItem->getOptionPrice(), '0.16');
        $this->assertEquals($firstOrderItem->getWeight(), '3.00');
        $this->assertEquals($firstOrderItem->getDimension(), null);
        $this->assertEquals($firstOrderItem->getWarehouseID(), '0');
        $this->assertEquals($firstOrderItem->getDateAdded(), '6/22/2009 12: 05: 07 PM');
        $this->assertEquals($firstOrderItem->getPageAdded(), 'Tote-Bag_p_3.html');
        $this->assertEquals($firstOrderItem->getProdType(), 'Tangible');
        $this->assertEquals($firstOrderItem->isTaxable(), '0');
        $this->assertEquals($firstOrderItem->getItemPrice(), '1.01');
        $this->assertEquals($firstOrderItem->getTotal(), '1.02');
        $this->assertEquals($firstOrderItem->getWarehouseLocation(), null);
        $this->assertEquals($firstOrderItem->getWarehouseBin(), null);
        $this->assertEquals($firstOrderItem->getWarehouseAisle(), null);
        $this->assertEquals($firstOrderItem->getWarehouseCustom(), null);
        
        $this->assertEquals(true, is_array($firstOrder->getCheckoutQuestions()));
        
        /** @var CheckoutQuestion $firstCheckoutQuestion */
        $firstCheckoutQuestion = current($firstOrder->getCheckoutQuestions());
        $this->assertInstanceOf(CheckoutQuestion::class, $firstCheckoutQuestion);
        $this->assertEquals($firstCheckoutQuestion->getId(), '1');
        $this->assertEquals($firstCheckoutQuestion->getQuestion(), 'What can a checkout question be?');
        $this->assertEquals($firstCheckoutQuestion->getAnswer(), 'Answer1');
    }
    
    public function testUpdateProductInventory()
    {
        $this->subjectUnderTest->setSoapClient($this->getSoapClientMock('updateProductInventory'));
        $success = $this->subjectUnderTest->updateProductInventory(1005, 1000);
        
        $this->assertEquals(true, $success);
    }
    
    public function testUpdateOrderStatus()
    {
        $this->subjectUnderTest->setSoapClient($this->getSoapClientMock('updateOrderStatus'));
        $success = $this->subjectUnderTest->updateOrderStatus('AB-1000', 'Processing');
        
        $this->assertEquals(true, $success);
    }
    
    public function testUpdateOrderShipment()
    {
        $this->subjectUnderTest->setSoapClient($this->getSoapClientMock('updateOrderShipment'));
        $success = $this->subjectUnderTest->updateOrderShipment('AB-1000', '0', '123456789', '2016-11-06');
        
        $this->assertEquals(true, $success);
    }
    
    /**
     * @param string $method
     *
     * @return \PHPUnit_Framework_MockObject_MockObject | ClientInterface
     */
    private function getSoapClientMock($method)
    {
        $methods        = array(
            '__construct',
            'getProduct',
            'getCustomers',
            'getOrderStatus',
            'getProductCount',
            'getProductInventory',
            'getCustomerLoginToken',
            'getCustomerCount',
            'getOrderCount',
            'getOrders',
            'updateProductInventory',
            'updateOrderStatus',
            'updateOrderShipment',
            'editCustomer'
        );
        $soapClientMock = $this->getMockBuilder(ClientInterface::class)
                               ->setConstructorArgs(array('', ''))
                               ->setMethods($methods)
                               ->getMock()
        ;
        $soapClientMock->method($method)->willReturn($this->getResponseMock($method));
        
        return $soapClientMock;
    }
    
    /**
     * @param string $method
     *
     * @return Xml
     */
    private function getResponseMock($method)
    {
        return new Xml(new StringValueObject($this->loadMock($method, 'response.xml')));
    }
}
