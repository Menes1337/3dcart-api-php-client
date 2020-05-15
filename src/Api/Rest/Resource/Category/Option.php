<?php

namespace ThreeDCart\Api\Rest\Resource\Category;

use ThreeDCart\Api\Rest\Resource\AbstractResource;

/**
 * @package ThreeDCart\Api\Rest\Resource\Category
 *
 * @method static Option fromArray(array $properties)
 * @method static Option[] fromList(array $list)
 */
class Option extends AbstractResource
{
    /** @var int */
    public $OptionID;
    
    /** @var string */
    public $OptionName;
    
    /** @var bool */
    public $OptionSelected;
    
    /** @var bool */
    public $OptionHide;
    
    /** @var float */
    public $OptionValue;
    
    /** @var string */
    public $OptionPartNumber;
    
    /** @var float */
    public $OptionSorting;
    
    /** @var string */
    public $OptionImagePath;
    
    /** @var int */
    public $OptionBundleCatalogId;
    
    /** @var int */
    public $OptionBundleQuantity;
}
