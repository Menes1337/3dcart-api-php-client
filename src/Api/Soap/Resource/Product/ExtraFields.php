<?php

namespace ThreeDCart\Api\Soap\Resource\Product;

use ThreeDCart\Api\Soap\Resource\SoapResource;
use ThreeDCart\Api\Soap\Resource\VisitorInterface;

/**
 * Class ExtraFields
 *
 * @package ThreeDCart\Api\Soap\Resource\Product
 */
class ExtraFields extends SoapResource
{
    /** @var string */
    private $ExtraField1;
    /** @var string */
    private $ExtraField2;
    /** @var string */
    private $ExtraField3;
    /** @var string */
    private $ExtraField4;
    /** @var string */
    private $ExtraField5;
    /** @var string */
    private $ExtraField6;
    /** @var string */
    private $ExtraField7;
    /** @var string */
    private $ExtraField8;
    /** @var string */
    private $ExtraField9;
    /** @var string */
    private $ExtraField10;
    /** @var string */
    private $ExtraField11;
    /** @var string */
    private $ExtraField12;
    /** @var string */
    private $ExtraField13;
    
    /**
     * @return string
     */
    public function getExtraField1()
    {
        return $this->ExtraField1;
    }
    
    /**
     * @param string $ExtraField1
     */
    public function setExtraField1($ExtraField1)
    {
        $this->ExtraField1 = $ExtraField1;
    }
    
    /**
     * @return string
     */
    public function getExtraField2()
    {
        return $this->ExtraField2;
    }
    
    /**
     * @param string $ExtraField2
     */
    public function setExtraField2($ExtraField2)
    {
        $this->ExtraField2 = $ExtraField2;
    }
    
    /**
     * @return string
     */
    public function getExtraField3()
    {
        return $this->ExtraField3;
    }
    
    /**
     * @param string $ExtraField3
     */
    public function setExtraField3($ExtraField3)
    {
        $this->ExtraField3 = $ExtraField3;
    }
    
    /**
     * @return string
     */
    public function getExtraField4()
    {
        return $this->ExtraField4;
    }
    
    /**
     * @param string $ExtraField4
     */
    public function setExtraField4($ExtraField4)
    {
        $this->ExtraField4 = $ExtraField4;
    }
    
    /**
     * @return string
     */
    public function getExtraField5()
    {
        return $this->ExtraField5;
    }
    
    /**
     * @param string $ExtraField5
     */
    public function setExtraField5($ExtraField5)
    {
        $this->ExtraField5 = $ExtraField5;
    }
    
    /**
     * @return string
     */
    public function getExtraField6()
    {
        return $this->ExtraField6;
    }
    
    /**
     * @param string $ExtraField6
     */
    public function setExtraField6($ExtraField6)
    {
        $this->ExtraField6 = $ExtraField6;
    }
    
    /**
     * @return string
     */
    public function getExtraField7()
    {
        return $this->ExtraField7;
    }
    
    /**
     * @param string $ExtraField7
     */
    public function setExtraField7($ExtraField7)
    {
        $this->ExtraField7 = $ExtraField7;
    }
    
    /**
     * @return string
     */
    public function getExtraField8()
    {
        return $this->ExtraField8;
    }
    
    /**
     * @param string $ExtraField8
     */
    public function setExtraField8($ExtraField8)
    {
        $this->ExtraField8 = $ExtraField8;
    }
    
    /**
     * @return string
     */
    public function getExtraField9()
    {
        return $this->ExtraField9;
    }
    
    /**
     * @param string $ExtraField9
     */
    public function setExtraField9($ExtraField9)
    {
        $this->ExtraField9 = $ExtraField9;
    }
    
    /**
     * @return string
     */
    public function getExtraField10()
    {
        return $this->ExtraField10;
    }
    
    /**
     * @param string $ExtraField10
     */
    public function setExtraField10($ExtraField10)
    {
        $this->ExtraField10 = $ExtraField10;
    }
    
    /**
     * @return string
     */
    public function getExtraField11()
    {
        return $this->ExtraField11;
    }
    
    /**
     * @param string $ExtraField11
     */
    public function setExtraField11($ExtraField11)
    {
        $this->ExtraField11 = $ExtraField11;
    }
    
    /**
     * @return string
     */
    public function getExtraField12()
    {
        return $this->ExtraField12;
    }
    
    /**
     * @param string $ExtraField12
     */
    public function setExtraField12($ExtraField12)
    {
        $this->ExtraField12 = $ExtraField12;
    }
    
    /**
     * @return string
     */
    public function getExtraField13()
    {
        return $this->ExtraField13;
    }
    
    /**
     * @param string $ExtraField13
     */
    public function setExtraField13($ExtraField13)
    {
        $this->ExtraField13 = $ExtraField13;
    }
    
    public function accept(VisitorInterface $visitor)
    {
        $visitor->visitProductExtraFields($this);
    }
}
