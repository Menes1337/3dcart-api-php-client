<?php

namespace ThreeDCart\Api\Soap\Resources\Product;

use ThreeDCart\Api\Soap\Resources\SoapResource;
use ThreeDCart\Api\Soap\Resources\VisitorInterface;

class Images extends SoapResource
{
    /** @var Images[] */
    private $Images;
    /** @var string */
    private $Thumbnail;
    
    /**
     * @return Images[]
     */
    public function getImages()
    {
        return $this->Images;
    }
    
    /**
     * @param Images[] $Images
     */
    public function setImages($Images)
    {
        $this->Images = $Images;
    }
    
    /**
     * @return string
     */
    public function getThumbnail()
    {
        return $this->Thumbnail;
    }
    
    /**
     * @param string $Thumbnail
     */
    public function setThumbnail($Thumbnail)
    {
        $this->Thumbnail = $Thumbnail;
    }
    
    public function accept(VisitorInterface $visitor)
    {
        $visitor->visitProductImages($this);
    }
}
