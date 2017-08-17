<?php

namespace ThreeDCart\Api\Rest\Resource\Product;

use ThreeDCart\Api\Rest\Resource\AbstractResource;

/**
 * @package ThreeDCart\Api\Rest\Resource\Product
 *
 * @method static UpSellingItem fromArray(array $properties)
 * @method static UpSellingItem[] fromList(array $list)
 */
class UpSellingItem extends AbstractResource
{
    /** @var int */
    public $UpSellingIndexID;
    
    /** @var int */
    public $UpSellingItemID;
    
    /** @var int */
    public $UpSellingItemSorting;
}
