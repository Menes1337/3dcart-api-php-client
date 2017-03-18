<?php

namespace ThreeDCart\Api\Soap\Resource\Product;

use ThreeDCart\Api\Soap\Resource\SoapResource;
use ThreeDCart\Api\Soap\Resource\VisitorInterface;

/**
 * Class Image
 *
 * @package ThreeDCart\Api\Soap\Resource\Product
 */
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
