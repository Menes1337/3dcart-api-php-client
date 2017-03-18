<?php

namespace ThreeDCart\Api\Soap\Resource\Product;

use ThreeDCart\Api\Soap\Resource\SoapResource;
use ThreeDCart\Api\Soap\Resource\VisitorInterface;

/**
 * Class PriceLevel
 *
 * @package ThreeDCart\Api\Soap\Resource\Product
 */
class PriceLevel extends SoapResource
{
    /** @var float */
    private $Price_1;
    /** @var float */
    private $Price_2;
    /** @var float */
    private $Price_3;
    /** @var float */
    private $Price_4;
    /** @var float */
    private $Price_5;
    /** @var float */
    private $Price_6;
    /** @var float */
    private $Price_7;
    /** @var float */
    private $Price_8;
    /** @var float */
    private $Price_9;
    /** @var float */
    private $Price_10;
    
    /**
     * @return float
     */
    public function getPrice_1()
    {
        return $this->Price_1;
    }
    
    /**
     * @param float $Price_1
     */
    public function setPrice_1($Price_1)
    {
        $this->Price_1 = $Price_1;
    }
    
    /**
     * @return float
     */
    public function getPrice_2()
    {
        return $this->Price_2;
    }
    
    /**
     * @param float $Price_2
     */
    public function setPrice_2($Price_2)
    {
        $this->Price_2 = $Price_2;
    }
    
    /**
     * @return float
     */
    public function getPrice_3()
    {
        return $this->Price_3;
    }
    
    /**
     * @param float $Price_3
     */
    public function setPrice_3($Price_3)
    {
        $this->Price_3 = $Price_3;
    }
    
    /**
     * @return float
     */
    public function getPrice_4()
    {
        return $this->Price_4;
    }
    
    /**
     * @param float $Price_4
     */
    public function setPrice_4($Price_4)
    {
        $this->Price_4 = $Price_4;
    }
    
    /**
     * @return float
     */
    public function getPrice_5()
    {
        return $this->Price_5;
    }
    
    /**
     * @param float $Price_5
     */
    public function setPrice_5($Price_5)
    {
        $this->Price_5 = $Price_5;
    }
    
    /**
     * @return float
     */
    public function getPrice_6()
    {
        return $this->Price_6;
    }
    
    /**
     * @param float $Price_6
     */
    public function setPrice_6($Price_6)
    {
        $this->Price_6 = $Price_6;
    }
    
    /**
     * @return float
     */
    public function getPrice_7()
    {
        return $this->Price_7;
    }
    
    /**
     * @param float $Price_7
     */
    public function setPrice_7($Price_7)
    {
        $this->Price_7 = $Price_7;
    }
    
    /**
     * @return float
     */
    public function getPrice_8()
    {
        return $this->Price_8;
    }
    
    /**
     * @param float $Price_8
     */
    public function setPrice_8($Price_8)
    {
        $this->Price_8 = $Price_8;
    }
    
    /**
     * @return float
     */
    public function getPrice_9()
    {
        return $this->Price_9;
    }
    
    /**
     * @param float $Price_9
     */
    public function setPrice_9($Price_9)
    {
        $this->Price_9 = $Price_9;
    }
    
    /**
     * @return float
     */
    public function getPrice_10()
    {
        return $this->Price_10;
    }
    
    /**
     * @param float $Price_10
     */
    public function setPrice_10($Price_10)
    {
        $this->Price_10 = $Price_10;
    }
    
    public function accept(VisitorInterface $visitor)
    {
        $visitor->visitProductPriceLevel($this);
    }
}
