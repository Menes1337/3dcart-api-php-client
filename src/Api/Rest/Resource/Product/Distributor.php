<?php

namespace ThreeDCart\Api\Rest\Resource\Product;

use ThreeDCart\Api\Rest\Resource\AbstractResource;

/**
 * @package ThreeDCart\Api\Rest\Resource\Product
 *
 * @method static Distributor fromArray(array $properties)
 * @method static Distributor[] fromList(array $list)
 */
class Distributor extends AbstractResource
{
    /** @var int */
    public $DistributorID;
    
    /** @var string */
    public $DistributorName;
    
    /** @var float */
    public $DistributorItemCost;
    
    /** @var string */
    public $DistributorItemID;
    
    /** @var string */
    public $DistributorStockID;
}
