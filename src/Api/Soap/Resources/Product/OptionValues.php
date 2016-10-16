<?php

namespace ThreeDCart\Api\Soap\Resources\Product;

use ThreeDCart\Api\Soap\Resources\SoapResource;

class OptionValues extends SoapResource
{
    /** @var int */
    private $ID;
    /** @var string */
    private $Name;
    /** @var float */
    private $OptionPrice;
    /** @var string */
    private $OptionPartNumber;
    
    /**
     * @return int
     */
    public function getID()
    {
        return $this->ID;
    }
    
    /**
     * @param int $ID
     */
    public function setID($ID)
    {
        $this->ID = $ID;
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->Name;
    }
    
    /**
     * @param string $Name
     */
    public function setName($Name)
    {
        $this->Name = $Name;
    }
    
    /**
     * @return float
     */
    public function getOptionPrice()
    {
        return $this->OptionPrice;
    }
    
    /**
     * @param float $OptionPrice
     */
    public function setOptionPrice($OptionPrice)
    {
        $this->OptionPrice = $OptionPrice;
    }
    
    /**
     * @return string
     */
    public function getOptionPartNumber()
    {
        return $this->OptionPartNumber;
    }
    
    /**
     * @param string $OptionPartNumber
     */
    public function setOptionPartNumber($OptionPartNumber)
    {
        $this->OptionPartNumber = $OptionPartNumber;
    }
}
