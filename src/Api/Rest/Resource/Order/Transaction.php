<?php

namespace ThreeDCart\Api\Rest\Resource\Order;

use ThreeDCart\Api\Rest\Resource\AbstractResource;

/**
 * @method static Transaction fromArray(array $properties)
 * @method static Transaction[] fromList(array $list)
 */
class Transaction extends AbstractResource
{
    /** @var int */
    public $TransactionIndexID;
    
    /** @var int */
    public $OrderID;
    
    /** @var string */
    public $TransactionID;
    
    /** @var string */
    public $TransactionDateTime;
    
    /** @var string */
    public $TransactionType;
    
    /** @var string */
    public $TransactionMethod;
    
    /** @var float */
    public $TransactionAmount;
    
    /** @var string */
    public $TransactionApproval;
    
    /** @var string */
    public $TransactionReference;
    
    /** @var int */
    public $TransactionGatewayID;
    
    /** @var string */
    public $TransactionCVV2;
    
    /** @var string */
    public $TransactionAVS;
    
    /** @var string */
    public $TransactionResponseText;
    
    /** @var string */
    public $TransactionResponseCode;
    
    /** @var int */
    public $TransactionCaptured;
}
