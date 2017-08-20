<?php

namespace ThreeDCart\Api\Rest\Resource\Order;

use ThreeDCart\Api\Rest\Resource\AbstractResource;

/**
 * @method static OrderItem fromArray(array $properties)
 * @method static OrderItem[] fromList(array $list)
 */
class OrderItem extends AbstractResource
{
    /** @var int */
    public $CatalogID;
    
    /** @var int */
    public $ItemIndexID;
    
    /** @var string */
    public $ItemID;
    
    /** @var int */
    public $ItemShipmentID;
    
    /** @var float */
    public $ItemQuantity;
    
    /** @var int */
    public $ItemWarehouseID;
    
    /** @var string */
    public $ItemDescription;
    
    /** @var float */
    public $ItemUnitPrice;
    
    /** @var float */
    public $ItemWeight;
    
    /** @var float */
    public $ItemOptionPrice;
    
    /** @var string */
    public $ItemAdditionalField1;
    
    /** @var string */
    public $ItemAdditionalField2;
    
    /** @var string */
    public $ItemAdditionalField3;
    
    /** @var string */
    public $ItemPageAdded;
    
    /** @var string */
    public $ItemDateAdded;
    
    /** @var float */
    public $ItemUnitCost;
    
    /** @var float */
    public $ItemUnitStock;
    
    /** @var string */
    public $ItemOptions;
    
    /** @var string */
    public $ItemCatalogIDOptions;
    
    /** @var string */
    public $ItemSerial;
    
    /** @var string */
    public $ItemImage1;
    
    /** @var string */
    public $ItemImage2;
    
    /** @var string */
    public $ItemImage3;
    
    /** @var string */
    public $ItemImage4;
    
    /** @var string */
    public $ItemWarehouseLocation;
    
    /** @var string */
    public $ItemWarehouseBin;
    
    /** @var string */
    public $ItemWarehouseAisle;
    
    /** @var string */
    public $ItemWarehouseCustom;
}
