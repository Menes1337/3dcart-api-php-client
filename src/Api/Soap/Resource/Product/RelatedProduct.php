<?php

namespace ThreeDCart\Api\Soap\Resource\Product;

use ThreeDCart\Api\Soap\Resource\SoapResource;
use ThreeDCart\Api\Soap\Resource\VisitorInterface;

/**
 * Class RelatedProduct
 *
 * @package ThreeDCart\Api\Soap\Resource\Product
 */
class RelatedProduct extends SoapResource
{
    /** @var int */
    private $ProductID;
    /** @var string */
    private $ProductName;
    
    /**
     * @return int
     */
    public function getProductID()
    {
        return $this->ProductID;
    }
    
    /**
     * @param int $ProductID
     */
    public function setProductID($ProductID)
    {
        $this->ProductID = $ProductID;
    }
    
    /**
     * @return string
     */
    public function getProductName()
    {
        return $this->ProductName;
    }
    
    /**
     * @param string $ProductName
     */
    public function setProductName($ProductName)
    {
        $this->ProductName = $ProductName;
    }
    
    public function accept(VisitorInterface $visitor)
    {
        $visitor->visitProductRelatedProduct($this);
    }
}
