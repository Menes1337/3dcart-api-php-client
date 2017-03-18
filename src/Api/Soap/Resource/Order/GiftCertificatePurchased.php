<?php

namespace ThreeDCart\Api\Soap\Resource\Order;

use ThreeDCart\Api\Soap\Resource\SoapResource;
use ThreeDCart\Api\Soap\Resource\VisitorInterface;

/**
 * Class GiftCertificatePurchased
 *
 * @package ThreeDCart\Api\Soap\Resource\Order
 */
class GiftCertificatePurchased extends SoapResource
{
    /** @var string */
    private $Code;
    /** @var float */
    private $Amount;
    /** @var string */
    private $ToName;
    /** @var string */
    private $ToEmail;
    /** @var string */
    private $ToMessage;
    /** @var string */
    private $FromName;
    
    /**
     * @return string
     */
    public function getCode()
    {
        return $this->Code;
    }
    
    /**
     * @param string $Code
     */
    public function setCode($Code)
    {
        $this->Code = $Code;
    }
    
    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->Amount;
    }
    
    /**
     * @param float $Amount
     */
    public function setAmount($Amount)
    {
        $this->Amount = $Amount;
    }
    
    /**
     * @return string
     */
    public function getToName()
    {
        return $this->ToName;
    }
    
    /**
     * @param string $ToName
     */
    public function setToName($ToName)
    {
        $this->ToName = $ToName;
    }
    
    /**
     * @return string
     */
    public function getToEmail()
    {
        return $this->ToEmail;
    }
    
    /**
     * @param string $ToEmail
     */
    public function setToEmail($ToEmail)
    {
        $this->ToEmail = $ToEmail;
    }
    
    /**
     * @return string
     */
    public function getToMessage()
    {
        return $this->ToMessage;
    }
    
    /**
     * @param string $ToMessage
     */
    public function setToMessage($ToMessage)
    {
        $this->ToMessage = $ToMessage;
    }
    
    /**
     * @return string
     */
    public function getFromName()
    {
        return $this->FromName;
    }
    
    /**
     * @param string $FromName
     */
    public function setFromName($FromName)
    {
        $this->FromName = $FromName;
    }
    
    public function accept(VisitorInterface $visitor)
    {
        $visitor->visitOrderGiftCertificatePurchased($this);
    }
}
