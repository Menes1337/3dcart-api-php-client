<?php

namespace ThreeDCart\Api\Soap\Resources\Order;

use ThreeDCart\Api\Soap\Resources\SoapResource;
use ThreeDCart\Api\Soap\Resources\VisitorInterface;

class Comments extends SoapResource
{
    /** @var string */
    private $OrderComment;
    /** @var string */
    private $OrderInternalComment;
    /** @var string */
    private $OrderExternalComment;
    
    /**
     * @return string
     */
    public function getOrderComment()
    {
        return $this->OrderComment;
    }
    
    /**
     * @param string $OrderComment
     */
    public function setOrderComment($OrderComment)
    {
        $this->OrderComment = $OrderComment;
    }
    
    /**
     * @return string
     */
    public function getOrderInternalComment()
    {
        return $this->OrderInternalComment;
    }
    
    /**
     * @param string $OrderInternalComment
     */
    public function setOrderInternalComment($OrderInternalComment)
    {
        $this->OrderInternalComment = $OrderInternalComment;
    }
    
    /**
     * @return string
     */
    public function getOrderExternalComment()
    {
        return $this->OrderExternalComment;
    }
    
    /**
     * @param string $OrderExternalComment
     */
    public function setOrderExternalComment($OrderExternalComment)
    {
        $this->OrderExternalComment = $OrderExternalComment;
    }
    
    public function accept(VisitorInterface $visitor)
    {
        $visitor->visitOrderComments($this);
    }
}
