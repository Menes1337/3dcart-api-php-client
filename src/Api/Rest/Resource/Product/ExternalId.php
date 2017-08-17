<?php

namespace ThreeDCart\Api\Rest\Resource\Product;

use ThreeDCart\Api\Rest\Resource\AbstractResource;

/**
 * @package ThreeDCart\Api\Rest\Resource\Product
 *
 * @method static ExternalId fromArray(array $properties)
 * @method static ExternalId[] fromList(array $list)
 */
class ExternalId extends AbstractResource
{
    /** @var int */
    public $ID;
    
    /** @var string */
    public $AdvancedOptionSufix;
    
    /** @var string */
    public $ExternalId1;
    
    /** @var string */
    public $ExternalId2;
    
    /** @var string */
    public $ExternalIdType;
}
