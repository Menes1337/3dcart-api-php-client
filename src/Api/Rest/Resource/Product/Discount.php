<?php

namespace ThreeDCart\Api\Rest\Resource\Product;

use ThreeDCart\Api\Rest\Resource\AbstractResource;

/**
 * @package ThreeDCart\Api\Rest\Resource\Product
 *
 * @method static Discount fromArray(array $properties)
 * @method static Discount[] fromList(array $list)
 */
class Discount extends AbstractResource
{
    /** @var int */
    public $DiscountID;
    
    /** @var int */
    public $DiscountPriceLevel;
    
    /** @var int */
    public $DiscountLowbound;
    
    /** @var int */
    public $DiscountUpbound;
    
    /** @var float */
    public $DiscountPrice;
    
    /** @var bool */
    public $DiscountPercentage;
}
