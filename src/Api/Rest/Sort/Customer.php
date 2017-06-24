<?php

namespace ThreeDCart\Api\Rest\Sort;

use ThreeDCart\Primitive\StringValueObject;

class Customer extends AbstractOrderBy
{
    const DEFAULT_SORT_ORDER = SortOrder::SORTING_ASC;
    
    public function __construct(\ThreeDCart\Api\Rest\Field\Customer $orderBy, SortOrder $sortOrder = null)
    {
        if ($sortOrder == null) {
            $sortOrder = new SortOrder(self::DEFAULT_SORT_ORDER);
        }
        
        parent::__construct(new StringValueObject($orderBy->getValue()), $sortOrder);
    }
}
