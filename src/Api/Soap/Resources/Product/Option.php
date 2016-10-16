<?php

namespace ThreeDCart\Api\Soap\Resources\Product;

use ThreeDCart\Api\Soap\Resources\SoapResource;

class Option extends SoapResource 
{
    /** @var int */
    private $Id;
    /** @var string */
    private $OptionType;
    /** @var OptionValues */
    private $Values;
    
    /**
     * @return int
     */
    public function getId()
    {
        return $this->Id;
    }
    
    /**
     * @param int $Id
     */
    public function setId($Id)
    {
        $this->Id = $Id;
    }
    
    /**
     * @return string
     */
    public function getOptionType()
    {
        return $this->OptionType;
    }
    
    /**
     * @param string $OptionType
     */
    public function setOptionType($OptionType)
    {
        $this->OptionType = $OptionType;
    }
    
    /**
     * @return OptionValues
     */
    public function getValues()
    {
        return $this->Values;
    }
    
    /**
     * @param OptionValues $Values
     */
    public function setValues($Values)
    {
        $this->Values = $Values;
    }
}
