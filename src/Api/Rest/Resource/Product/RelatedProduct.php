<?php

namespace ThreeDCart\Api\Rest\Resource\Product;

use ThreeDCart\Api\Rest\Resource\AbstractResource;

/**
 * @package ThreeDCart\Api\Rest\Resource\Product
 *
 * @method static RelatedProduct fromArray(array $data)
 * @method static RelatedProduct[] fromList(array $list)
 */
class RelatedProduct extends AbstractResource
{
    /** @var int */
    public $RelatedIndexID;
    
    /** @var int */
    public $RelatedProductID;
    
    /** @var int */
    public $RelatedProductSorting;
}
