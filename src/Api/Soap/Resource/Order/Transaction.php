<?php

namespace ThreeDCart\Api\Soap\Resource\Order;

use ThreeDCart\Api\Soap\Resource\SoapResource;
use ThreeDCart\Api\Soap\Resource\VisitorInterface;

/**
 * Class Transaction
 *
 * @package ThreeDCart\Api\Soap\Resource\Order
 */
class Transaction extends SoapResource
{
    /** @var string */
    private $CVV2;
    /** @var string */
    private $ResponseText;
    /** @var string */
    private $AVS;
    /** @var string */
    private $TransactionId;
    /** @var int */
    private $ApprovalCode;
    /** @var string */
    private $TransactionType;
    /** @var float */
    private $Amount;
    
    /**
     * @return string
     */
    public function getCVV2()
    {
        return $this->CVV2;
    }
    
    /**
     * @param string $CVV2
     */
    public function setCVV2($CVV2)
    {
        $this->CVV2 = $CVV2;
    }
    
    /**
     * @return string
     */
    public function getResponseText()
    {
        return $this->ResponseText;
    }
    
    /**
     * @param string $ResponseText
     */
    public function setResponseText($ResponseText)
    {
        $this->ResponseText = $ResponseText;
    }
    
    /**
     * @return string
     */
    public function getAVS()
    {
        return $this->AVS;
    }
    
    /**
     * @param string $AVS
     */
    public function setAVS($AVS)
    {
        $this->AVS = $AVS;
    }
    
    /**
     * @return string
     */
    public function getTransactionId()
    {
        return $this->TransactionId;
    }
    
    /**
     * @param string $TransactionId
     */
    public function setTransactionId($TransactionId)
    {
        $this->TransactionId = $TransactionId;
    }
    
    /**
     * @return int
     */
    public function getApprovalCode()
    {
        return $this->ApprovalCode;
    }
    
    /**
     * @param int $ApprovalCode
     */
    public function setApprovalCode($ApprovalCode)
    {
        $this->ApprovalCode = $ApprovalCode;
    }
    
    /**
     * @return string
     */
    public function getTransactionType()
    {
        return $this->TransactionType;
    }
    
    /**
     * @param string $TransactionType
     */
    public function setTransactionType($TransactionType)
    {
        $this->TransactionType = $TransactionType;
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
        $visitor->visitOrderTransaction($this);
    }
}
