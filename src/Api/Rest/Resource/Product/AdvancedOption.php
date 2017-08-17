<?php

namespace ThreeDCart\Api\Rest\Resource\Product;

use ThreeDCart\Api\Rest\Resource\AbstractResource;

/**
 * @package ThreeDCart\Api\Rest\Resource\Product
 *
 * @method static AdvancedOption fromArray(array $properties)
 * @method static AdvancedOption[] fromList(array $list)
 */
class AdvancedOption extends AbstractResource
{
    /** @var string */
    public $AdvancedOptionCode;
    
    /** @var string */
    public $AdvancedOptionSufix;
    
    /** @var string */
    public $AdvancedOptionName;
    
    /** @var float */
    public $AdvancedOptionCost;
    
    /** @var int */
    public $AdvancedOptionStock;
    
    /** @var float */
    public $AdvancedOptionWeight;
    
    /** @var float */
    public $AdvancedOptionPrice;
    
    /** @var string */
    public $AdvancedOptionGTIN;
}
