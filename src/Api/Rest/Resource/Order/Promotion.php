<?php

namespace ThreeDCart\Api\Rest\Resource\Order;

use ThreeDCart\Api\Rest\Resource\AbstractResource;

/**
 * @method static Promotion fromArray(array $properties)
 * @method static Promotion[] fromList(array $list)
 */
class Promotion extends AbstractResource
{
    /** @var string */
    public $PromotionName;
    
    /** @var string */
    public $Coupon;
    
    /** @var float */
    public $DiscountAmount;
}
