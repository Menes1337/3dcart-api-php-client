<?php

namespace ThreeDCart\Api\Rest\Resource\Product;

use ThreeDCart\Api\Rest\Resource\AbstractResource;

/**
 * @package ThreeDCart\Api\Rest\Resource\Product
 *
 * @method static Category fromArray(array $data)
 * @method static Category[] fromList(array $list)
 */
class Category extends AbstractResource
{
    /** @var int */
    public $CategoryID;
    
    /** @var string */
    public $CategoryName;
}
