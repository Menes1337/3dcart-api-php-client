<?php

namespace ThreeDCart\Api\Soap\Resource\Product;

use ThreeDCart\Api\Soap\Resource\SoapResource;
use ThreeDCart\Api\Soap\Resource\VisitorInterface;

/**
 * Class ProductInventory
 *
 * @package ThreeDCart\Api\Soap\Resource\Product
 */
class ProductInventory extends SoapResource
{
    /** @var string */
    private $ProductID;
    /** @var int */
    private $Inventory;
    
    /**
     * @return string
     */
    public function getProductID()
    {
        return $this->ProductID;
    }
    
    /**
     * @param string $ProductID
     */
    public function setProductID($ProductID)
    {
        $this->ProductID = $ProductID;
    }
    
    /**
     * @return int
     */
    public function getInventory()
    {
        return $this->Inventory;
    }
    
    /**
     * @param int $Inventory
     */
    public function setInventory($Inventory)
    {
        $this->Inventory = $Inventory;
    }
    
    public function accept(VisitorInterface $visitor)
    {
        $visitor->visitProductInventory($this);
    }
}
