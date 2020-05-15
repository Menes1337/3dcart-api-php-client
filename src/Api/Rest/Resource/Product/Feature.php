<?php

namespace ThreeDCart\Api\Rest\Resource\Product;

use ThreeDCart\Api\Rest\Resource\AbstractResource;

/**
 * @package ThreeDCart\Api\Rest\Resource\Product
 *
 * @method static Feature fromArray(array $data)
 * @method static Feature[] fromList(array $list)
 */
class Feature extends AbstractResource
{
    /** @var int */
    public $FeatureID;
    
    /** @var string */
    public $FeatureTitle;
    
    /** @var string */
    public $FeatureDescription;
}
