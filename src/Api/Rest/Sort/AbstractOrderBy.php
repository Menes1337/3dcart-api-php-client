<?php

namespace ThreeDCart\Api\Rest\Sort;

use ThreeDCart\Primitive\StringValueObject;

abstract class AbstractOrderBy
{
    /** @var SortOrder */
    protected $sortOrder;
    
    /** @var StringValueObject */
    protected $orderBy;
    
    /**
     * @param StringValueObject $orderBy
     * @param SortOrder         $sortOrder
     */
    public function __construct(StringValueObject $orderBy, SortOrder $sortOrder)
    {
        $this->orderBy   = $orderBy;
        $this->sortOrder = $sortOrder;
    }
    
    /**
     * @return StringValueObject
     */
    public function getOrderByField()
    {
        return $this->orderBy;
    }
    
    /**
     * @return SortOrder
     */
    public function getSortOrder()
    {
        return $this->sortOrder;
    }
}
