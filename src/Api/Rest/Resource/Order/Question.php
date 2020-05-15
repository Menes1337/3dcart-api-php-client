<?php

namespace ThreeDCart\Api\Rest\Resource\Order;

use ThreeDCart\Api\Rest\Resource\AbstractResource;

/**
 * @method static Question fromArray(array $properties)
 * @method static Question[] fromList(array $list)
 */
class Question extends AbstractResource
{
    /** @var int */
    public $QuestionAnswerIndexID;
    
    /** @var int */
    public $OrderID;
    
    /** @var int */
    public $QuestionID;
    
    /** @var string */
    public $QuestionTitle;
    
    /** @var string */
    public $QuestionAnswer;
    
    /** @var string */
    public $QuestionType;
    
    /** @var int */
    public $QuestionCheckoutStep;
    
    /** @var int */
    public $QuestionSorting;
    
    /** @var int */
    public $QuestionDiscountGroup;
}
