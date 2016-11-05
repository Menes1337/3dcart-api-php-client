<?php

namespace ThreeDCart\Api\Soap\Resources\Order;

use ThreeDCart\Api\Soap\Resources\SoapResource;
use ThreeDCart\Api\Soap\Resources\VisitorInterface;

class OrderStatus extends SoapResource
{
    /** @var int */
    private $id = '';
    /** @var string */
    private $InvoiceNum = '';
    /** @var string */
    private $StatusText = '';
    
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
