<?php

namespace ThreeDCart\Api\Soap\Resource\Order;

use ThreeDCart\Api\Soap\Resource\SoapResource;
use ThreeDCart\Api\Soap\Resource\VisitorInterface;

/**
 * Class GiftCertificateUsed
 *
 * @package ThreeDCart\Api\Soap\Resource\Order
 */
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
