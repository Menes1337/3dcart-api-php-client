<?php

namespace ThreeDCart\Api\Soap\Resource\Order;

use ThreeDCart\Api\Soap\Resource\Customer\Address;
use ThreeDCart\Api\Soap\Resource\SoapResource;
use ThreeDCart\Api\Soap\Resource\VisitorInterface;

/**
 * Class Order
 *
 * @package ThreeDCart\Api\Soap\Resource\Order
 */
class Order extends SoapResource
{
    
    /** @var int */
    private $OrderID;
    /** @var string */
    private $InvoiceNumber;
    /** @var int */
    private $CustomerID;
    /** @var string */
    private $Date;
    /** @var float */
    private $Total;
    /** @var float */
    private $Tax;
    /** @var float */
    private $Tax2;
    /** @var float */
    private $Tax3;
    /** @var float */
    private $Shipping;
    /** @var Address */
    private $BillingAddress;
    /** @var Comments */
    private $Comments;
    /** @var string */
    private $PaymentMethod;
    /** @var string ?? */
    private $CardType;
    /** @var string */
    private $Time;
    /** @var Transaction */
    private $Transaction;
    /** @var float */
    private $Discount;
    /** @var Promotion[] */
    private $Promotions;
    /** @var GiftCertificatePurchased */
    private $GiftCertificatePurchased;
    /** @var GiftCertificateUsed */
    private $GiftCertificateUsed;
    /** @var string */
    private $OrderStatus;
    /** @var string */
    private $Referer;
    /** @var string */
    private $SalesPerson;
    /** @var string */
    private $IP;
    /** @var string */
    private $DateStarted;
    /** @var string */
    private $UserID;
    /** @var string */
    private $LastUpdate;
    /** @var float */
    private $Weight;
    /** @var AffiliateInformation */
    private $AffiliateInformation;
    /** @var ShippingInformation */
    private $ShippingInformation;
    /** @var CheckoutQuestion[] */
    private $CheckoutQuestions;
    
    /**
     * @return int
     */
    public function getOrderID()
    {
        return $this->OrderID;
    }
    
    /**
     * @param int $OrderID
     */
    public function setOrderID($OrderID)
    {
        $this->OrderID = $OrderID;
    }
    
    /**
     * @return string
     */
    public function getInvoiceNumber()
    {
        return $this->InvoiceNumber;
    }
    
    /**
     * @param string $InvoiceNumber
     */
    public function setInvoiceNumber($InvoiceNumber)
    {
        $this->InvoiceNumber = $InvoiceNumber;
    }
    
    /**
     * @return int
     */
    public function getCustomerID()
    {
        return $this->CustomerID;
    }
    
    /**
     * @param int $CustomerID
     */
    public function setCustomerID($CustomerID)
    {
        $this->CustomerID = $CustomerID;
    }
    
    /**
     * @return string
     */
    public function getDate()
    {
        return $this->Date;
    }
    
    /**
     * @param string $Date
     */
    public function setDate($Date)
    {
        $this->Date = $Date;
    }
    
    /**
     * @return float
     */
    public function getTotal()
    {
        return $this->Total;
    }
    
    /**
     * @param float $Total
     */
    public function setTotal($Total)
    {
        $this->Total = $Total;
    }
    
    /**
     * @return float
     */
    public function getTax()
    {
        return $this->Tax;
    }
    
    /**
     * @param float $Tax
     */
    public function setTax($Tax)
    {
        $this->Tax = $Tax;
    }
    
    /**
     * @return float
     */
    public function getTax2()
    {
        return $this->Tax2;
    }
    
    /**
     * @param float $Tax2
     */
    public function setTax2($Tax2)
    {
        $this->Tax2 = $Tax2;
    }
    
    /**
     * @return float
     */
    public function getTax3()
    {
        return $this->Tax3;
    }
    
    /**
     * @param float $Tax3
     */
    public function setTax3($Tax3)
    {
        $this->Tax3 = $Tax3;
    }
    
    /**
     * @return float
     */
    public function getShipping()
    {
        return $this->Shipping;
    }
    
    /**
     * @param float $Shipping
     */
    public function setShipping($Shipping)
    {
        $this->Shipping = $Shipping;
    }
    
    /**
     * @return Address
     */
    public function getBillingAddress()
    {
        return $this->BillingAddress;
    }
    
    /**
     * @param Address $BillingAddress
     */
    public function setBillingAddress($BillingAddress)
    {
        $this->BillingAddress = $BillingAddress;
    }
    
    /**
     * @return Comments
     */
    public function getComments()
    {
        return $this->Comments;
    }
    
    /**
     * @param Comments $Comments
     */
    public function setComments($Comments)
    {
        $this->Comments = $Comments;
    }
    
    /**
     * @return string
     */
    public function getPaymentMethod()
    {
        return $this->PaymentMethod;
    }
    
    /**
     * @param string $PaymentMethod
     */
    public function setPaymentMethod($PaymentMethod)
    {
        $this->PaymentMethod = $PaymentMethod;
    }
    
    /**
     * @return string
     */
    public function getCardType()
    {
        return $this->CardType;
    }
    
    /**
     * @param string $CardType
     */
    public function setCardType($CardType)
    {
        $this->CardType = $CardType;
    }
    
    /**
     * @return string
     */
    public function getTime()
    {
        return $this->Time;
    }
    
    /**
     * @param string $Time
     */
    public function setTime($Time)
    {
        $this->Time = $Time;
    }
    
    /**
     * @return Transaction
     */
    public function getTransaction()
    {
        return $this->Transaction;
    }
    
    /**
     * @param Transaction $Transaction
     */
    public function setTransaction($Transaction)
    {
        $this->Transaction = $Transaction;
    }
    
    /**
     * @return float
     */
    public function getDiscount()
    {
        return $this->Discount;
    }
    
    /**
     * @param float $Discount
     */
    public function setDiscount($Discount)
    {
        $this->Discount = $Discount;
    }
    
    /**
     * @return Promotion[]
     */
    public function getPromotions()
    {
        return $this->Promotions;
    }
    
    /**
     * @param Promotion[] $Promotions
     */
    public function setPromotions(array $Promotions)
    {
        $this->Promotions = $Promotions;
    }
    
    /**
     * @return GiftCertificatePurchased
     */
    public function getGiftCertificatePurchased()
    {
        return $this->GiftCertificatePurchased;
    }
    
    /**
     * @param GiftCertificatePurchased $GiftCertificatePurchased
     */
    public function setGiftCertificatePurchased($GiftCertificatePurchased)
    {
        $this->GiftCertificatePurchased = $GiftCertificatePurchased;
    }
    
    /**
     * @return GiftCertificateUsed
     */
    public function getGiftCertificateUsed()
    {
        return $this->GiftCertificateUsed;
    }
    
    /**
     * @param GiftCertificateUsed $GiftCertificateUsed
     */
    public function setGiftCertificateUsed($GiftCertificateUsed)
    {
        $this->GiftCertificateUsed = $GiftCertificateUsed;
    }
    
    /**
     * @return string
     */
    public function getOrderStatus()
    {
        return $this->OrderStatus;
    }
    
    /**
     * @param string $OrderStatus
     */
    public function setOrderStatus($OrderStatus)
    {
        $this->OrderStatus = $OrderStatus;
    }
    
    /**
     * @return string
     */
    public function getReferer()
    {
        return $this->Referer;
    }
    
    /**
     * @param string $Referer
     */
    public function setReferer($Referer)
    {
        $this->Referer = $Referer;
    }
    
    /**
     * @return string
     */
    public function getSalesPerson()
    {
        return $this->SalesPerson;
    }
    
    /**
     * @param string $SalesPerson
     */
    public function setSalesPerson($SalesPerson)
    {
        $this->SalesPerson = $SalesPerson;
    }
    
    /**
     * @return string
     */
    public function getIP()
    {
        return $this->IP;
    }
    
    /**
     * @param string $IP
     */
    public function setIP($IP)
    {
        $this->IP = $IP;
    }
    
    /**
     * @return string
     */
    public function getDateStarted()
    {
        return $this->DateStarted;
    }
    
    /**
     * @param string $DateStarted
     */
    public function setDateStarted($DateStarted)
    {
        $this->DateStarted = $DateStarted;
    }
    
    /**
     * @return string
     */
    public function getUserID()
    {
        return $this->UserID;
    }
    
    /**
     * @param string $UserID
     */
    public function setUserID($UserID)
    {
        $this->UserID = $UserID;
    }
    
    /**
     * @return string
     */
    public function getLastUpdate()
    {
        return $this->LastUpdate;
    }
    
    /**
     * @param string $LastUpdate
     */
    public function setLastUpdate($LastUpdate)
    {
        $this->LastUpdate = $LastUpdate;
    }
    
    /**
     * @return float
     */
    public function getWeight()
    {
        return $this->Weight;
    }
    
    /**
     * @param float $Weight
     */
    public function setWeight($Weight)
    {
        $this->Weight = $Weight;
    }
    
    /**
     * @return AffiliateInformation
     */
    public function getAffiliateInformation()
    {
        return $this->AffiliateInformation;
    }
    
    /**
     * @param AffiliateInformation $AffiliateInformation
     */
    public function setAffiliateInformation($AffiliateInformation)
    {
        $this->AffiliateInformation = $AffiliateInformation;
    }
    
    /**
     * @return ShippingInformation
     */
    public function getShippingInformation()
    {
        return $this->ShippingInformation;
    }
    
    /**
     * @param ShippingInformation $ShippingInformation
     */
    public function setShippingInformation($ShippingInformation)
    {
        $this->ShippingInformation = $ShippingInformation;
    }
    
    /**
     * @return CheckoutQuestion[]
     */
    public function getCheckoutQuestions()
    {
        return $this->CheckoutQuestions;
    }
    
    /**
     * @param CheckoutQuestion[] $CheckoutQuestions
     */
    public function setCheckoutQuestions($CheckoutQuestions)
    {
        $this->CheckoutQuestions = $CheckoutQuestions;
    }
    
    public function accept(VisitorInterface $visitor)
    {
        $visitor->visitOrder($this);
    }
}
