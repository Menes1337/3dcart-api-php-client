<?php

namespace ThreeDCart\Api\Soap\Resource\Product;

use ThreeDCart\Api\Soap\Resource\SoapResource;
use ThreeDCart\Api\Soap\Resource\VisitorInterface;

/**
 * Class Category
 *
 * @package ThreeDCart\Api\Soap\Resource\Product
 */
class Category extends SoapResource
{
    /** @var int */
    private $CategoryID;
    /** @var string */
    private $CategoryName;
    
    /**
     * @return int
     */
    public function getCategoryID()
    {
        return $this->CategoryID;
    }
    
    /**
     * @param int $CategoryID
     */
    public function setCategoryID($CategoryID)
    {
        $this->CategoryID = $CategoryID;
    }
    
    /**
     * @return string
     */
    public function getCategoryName()
    {
        return $this->CategoryName;
    }
    
    /**
     * @param string $CategoryName
     */
    public function setCategoryName($CategoryName)
    {
        $this->CategoryName = $CategoryName;
    }
    
    public function accept(VisitorInterface $visitor)
    {
        $visitor->visitProductCategory($this);
    }
}
