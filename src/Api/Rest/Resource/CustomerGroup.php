<?php

namespace ThreeDCart\Api\Rest\Resource;

/**
 * @package ThreeDCart\Api\Rest\Resource
 *
 * @method static CustomerGroup fromArray(array $properties)
 * @method static CustomerGroup[] fromList(array $list)
 */
class CustomerGroup extends AbstractResource
{
    /** @var int */
    public $CustomerGroupID;
    
    /** @var string */
    public $Name;
    
    /** @var string */
    public $Description;
    
    /** @var float */
    public $MinimumOrder;
    
    /** @var bool */
    public $NonTaxable;
    
    /** @var bool */
    public $AllowRegistration;
    
    /** @var bool */
    public $DisableRewardPoints;
    
    /** @var bool */
    public $AutoApprove;
    
    /** @var string */
    public $RegistrationMessage;
    
    /** @var int */
    public $PriceLevel;
}
