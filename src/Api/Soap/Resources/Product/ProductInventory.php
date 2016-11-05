<?php

namespace ThreeDCart\Api\Soap\Resources\Product;

use ThreeDCart\Api\Soap\Resources\SoapResource;
use ThreeDCart\Api\Soap\Resources\VisitorInterface;

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
