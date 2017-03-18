<?php

namespace ThreeDCart\Api\Soap\Resource\Order;

use ThreeDCart\Api\Soap\Resource\SoapResource;
use ThreeDCart\Api\Soap\Resource\VisitorInterface;

/**
 * Class Status
 *
 * @package ThreeDCart\Api\Soap\Resource\Order
 */
class Status extends SoapResource
{
    /** @var int */
    private $id;
    /** @var string */
    private $InvoiceNum;
    /** @var string */
    private $StatusText;
    
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * @return string
     */
    public function getInvoiceNum()
    {
        return $this->InvoiceNum;
    }
    
    /**
     * @param string $InvoiceNum
     */
    public function setInvoiceNum($InvoiceNum)
    {
        $this->InvoiceNum = $InvoiceNum;
    }
    
    /**
     * @return string
     */
    public function getStatusText()
    {
        return $this->StatusText;
    }
    
    /**
     * @param string $StatusText
     */
    public function setStatusText($StatusText)
    {
        $this->StatusText = $StatusText;
    }
    
    public function accept(VisitorInterface $visitor)
    {
        $visitor->visitOrderStatus($this);
    }
}
