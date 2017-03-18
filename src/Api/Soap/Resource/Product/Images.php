<?php

namespace ThreeDCart\Api\Soap\Resource\Product;

use ThreeDCart\Api\Soap\Resource\SoapResource;
use ThreeDCart\Api\Soap\Resource\VisitorInterface;

/**
 * Class Images
 *
 * @package ThreeDCart\Api\Soap\Resource\Product
 */
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
    public function setImages(array $Images)
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
