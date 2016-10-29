<?php

namespace ThreeDCart\Api\Soap\Resources\Product;

use ThreeDCart\Api\Soap\Resources\SoapResource;
use ThreeDCart\Api\Soap\Resources\VisitorInterface;

class Image extends SoapResource
{
    /** @var string */
    private $Url;
    /** @var string */
    private $Caption;
    
    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->Url;
    }
    
    /**
     * @param string $Url
     */
    public function setUrl($Url)
    {
        $this->Url = $Url;
    }
    
    /**
     * @return string
     */
    public function getCaption()
    {
        return $this->Caption;
    }
    
    /**
     * @param string $Caption
     */
    public function setCaption($Caption)
    {
        $this->Caption = $Caption;
    }
    
    public function accept(VisitorInterface $visitor)
    {
        $visitor->visitProductImage($this);
    }
}
