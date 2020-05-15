<?php

namespace ThreeDCart\Api\Rest\Resource;

/**
 * @package ThreeDCart\Api\Rest\Resource
 *
 * @method static Customer fromArray(array $properties)
 * @method static Customer[] fromList(array $list)
 */
class Customer extends AbstractResource
{
    /** @var int */
    public $CustomerID;
    
    /** @var string */
    public $Email;
    
    /** @var string */
    public $Password;
    
    /** @var string */
    public $BillingCompany;
    
    /** @var string */
    public $BillingFirstName;
    
    /** @var string */
    public $BillingLastName;
    
    /** @var string */
    public $BillingAddress1;
    
    /** @var string */
    public $BillingAddress2;
    
    /** @var string */
    public $BillingCity;
    
    /** @var string */
    public $BillingState;
    
    /** @var string */
    public $BillingZipCode;
    
    /** @var string */
    public $BillingCountry;
    
    /** @var string */
    public $BillingPhoneNumber;
    
    /** @var string */
    public $BillingTaxID;
    
    /** @var string */
    public $ShippingCompany;
    
    /** @var string */
    public $ShippingFirstName;
    
    /** @var string */
    public $ShippingLastName;
    
    /** @var string */
    public $ShippingAddress1;
    
    /** @var string */
    public $ShippingAddress2;
    
    /** @var string */
    public $ShippingCity;
    
    /** @var string */
    public $ShippingState;
    
    /** @var string */
    public $ShippingZipCode;
    
    /** @var string */
    public $ShippingCountry;
    
    /** @var string */
    public $ShippingPhoneNumber;
    
    /** @var int */
    public $ShippingAddressType;
    
    /** @var int */
    public $CustomerGroupID;
    
    /** @var bool */
    public $Enabled;
    
    /** @var bool */
    public $MailList;
    
    /** @var bool */
    public $NonTaxable;
    
    /** @var bool */
    public $DisableBillingSameAsShipping;
    
    /** @var string */
    public $Comments;
    
    /** @var string */
    public $AdditionalField1;
    
    /** @var string */
    public $AdditionalField2;
    
    /** @var string */
    public $AdditionalField3;
    
    /** @var float */
    public $TotalStoreCredit;
}
