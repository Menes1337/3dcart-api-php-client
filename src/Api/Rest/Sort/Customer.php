<?php

namespace ThreeDCart\Api\Rest\Sort;

use ThreeDCart\Primitive\StringValueObject;

class Customer extends AbstractOrderBy
{
    const DEFAULT_SORT_ORDER = Order::SORTING_ASC;
    
    public function __construct(\ThreeDCart\Api\Rest\Field\Customer $orderBy, Order $sortOrder = null)
    {
        if ($sortOrder == null) {
            $sortOrder = new Order(self::DEFAULT_SORT_ORDER);
        }
        
        parent::__construct(new StringValueObject($orderBy->getValue()), $sortOrder);
    }
}
