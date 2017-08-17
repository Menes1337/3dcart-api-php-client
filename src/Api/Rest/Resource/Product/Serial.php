<?php

namespace ThreeDCart\Api\Rest\Resource\Product;

use ThreeDCart\Api\Rest\Resource\AbstractResource;

/**
 * @package ThreeDCart\Api\Rest\Resource\Product
 *
 * @method static Serial fromArray(array $properties)
 * @method static Serial[] fromList(array $list)
 */
class Serial extends AbstractResource
{
    /** @var int */
    public $SerialID;
    
    /** @var int */
    public $SerialUses;
    
    /** @var string */
    public $SerialCode;
}
