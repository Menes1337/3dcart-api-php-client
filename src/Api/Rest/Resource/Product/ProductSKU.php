<?php

namespace ThreeDCart\Api\Rest\Resource\Product;

use ThreeDCart\Api\Rest\Resource\AbstractResource;

/**
 * @package ThreeDCart\Api\Rest\Resource\Product
 *
 * @method static ProductSKU fromArray(array $data)
 * @method static ProductSKU[] fromList(array $list)
 */
class ProductSKU extends AbstractResource
{
    /** @var int */
    public $CatalogID;
    
    /** @var string */
    public $SKU;
    
    /** @var string */
    public $Name;
    
    /** @var float */
    public $Cost;
    
    /** @var float */
    public $Price;
    
    /** @var string */
    public $Currency;
    
    /** @var float */
    public $RetailPrice;
    
    /** @var float */
    public $SalePrice;
    
    /** @var bool */
    public $OnSale;
    
    /** @var float */
    public $Stock;
}
