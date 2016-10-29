<?php

namespace ThreeDCart\Api\Soap\Resources\Product;

use ThreeDCart\Api\Soap\Resources\SoapResource;
use ThreeDCart\Api\Soap\Resources\VisitorInterface;

class Option extends SoapResource
{
    /** @var int */
    private $Id;
    /** @var string */
    private $OptionType;
    /** @var OptionValue[] */
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
     * @return OptionValue[]
     */
    public function getValues()
    {
        return $this->Values;
    }
    
    /**
     * @param OptionValue[] $Values
     */
    public function setValues($Values)
    {
        $this->Values = $Values;
    }
    
    public function accept(VisitorInterface $visitor)
    {
        $visitor->visitProductOption($this);
    }
}
