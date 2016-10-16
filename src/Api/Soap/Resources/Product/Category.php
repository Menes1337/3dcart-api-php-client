<?php

namespace ThreeDCart\Resources\catalog\product;

use ThreeDCart\Api\Soap\Resources\SoapResource;

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
}
