<?php

namespace ThreeDCart\Resources\catalog\product;

use ThreeDCart\Api\Soap\Resources\SoapResource;

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
}
