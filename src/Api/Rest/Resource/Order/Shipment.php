<?php

namespace ThreeDCart\Api\Rest\Resource\Order;

use ThreeDCart\Api\Rest\Resource\AbstractResource;

/**
 * @method static Shipment fromArray(array $properties)
 * @method static Shipment[] fromList(array $list)
 */
class Shipment extends AbstractResource
{
    /** @var int */
    public $ShipmentID;
    
    /** @var string */
    public $ShipmentLastUpdate;
    
    /** @var int */
    public $ShipmentBoxes;
    
    /** @var string */
    public $ShipmentInternalComment;
    
    /** @var int */
    public $ShipmentOrderStatus;
    
    /** @var string */
    public $ShipmentAddress;
    
    /** @var string */
    public $ShipmentAddress2;
    
    /** @var string */
    public $ShipmentAlias;
    
    /** @var string */
    public $ShipmentCity;
    
    /** @var string */
    public $ShipmentCompany;
    
    /** @var float */
    public $ShipmentCost;
    
    /** @var string */
    public $ShipmentCountry;
    
    /** @var string */
    public $ShipmentEmail;
    
    /** @var string */
    public $ShipmentFirstName;
    
    /** @var string */
    public $ShipmentLastName;
    
    /** @var int */
    public $ShipmentMethodID;
    
    /** @var string */
    public $ShipmentMethodName;
    
    /** @var string */
    public $ShipmentShippedDate;
    
    /** @var string */
    public $ShipmentPhone;
    
    /** @var string */
    public $ShipmentState;
    
    /** @var string */
    public $ShipmentZipCode;
    
    /** @var float */
    public $ShipmentTax;
    
    /** @var float */
    public $ShipmentWeight;
    
    /** @var string */
    public $ShipmentTrackingCode;
    
    /** @var string */
    public $ShipmentUserID;
    
    /** @var int */
    public $ShipmentNumber;
    
    /** @var int */
    public $ShipmentAddressTypeID;
}
