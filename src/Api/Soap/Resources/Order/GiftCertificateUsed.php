<?php

namespace ThreeDCart\Api\Soap\Resources\Order;

use ThreeDCart\Api\Soap\Resources\SoapResource;
use ThreeDCart\Api\Soap\Resources\VisitorInterface;

class GiftCertificateUsed extends SoapResource
{
    /** @var string */
    private $Code;
    /** @var float */
    private $Amount;
    
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
    
    public function accept(VisitorInterface $visitor)
    {
        $visitor->visitOrderGiftCertificateUsed($this);
    }
}
