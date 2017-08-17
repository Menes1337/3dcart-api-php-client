<?php

namespace ThreeDCart\Api\Rest\Resource\Product;

use ThreeDCart\Api\Rest\Resource\AbstractResource;

/**
 * @package ThreeDCart\Api\Rest\Resource\Product
 *
 * @method static ImageGallery fromArray(array $properties)
 * @method static ImageGallery[] fromList(array $list)
 */
class ImageGallery extends AbstractResource
{
    /** @var int */
    public $ImageGalleryID;
    
    /** @var string */
    public $ImageGalleryFile;
    
    /** @var string */
    public $ImageGalleryCaption;
    
    /** @var int */
    public $ImageGallerySorting;
}
