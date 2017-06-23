<?php

namespace ThreeDCart\Api\Rest\Sort;

use ThreeDCart\Primitive\StringValueObject;

abstract class AbstractOrderBy
{
    /** @var Order */
    protected $sortOrder;
    
    /** @var StringValueObject */
    protected $orderBy;
    
    /**
     * @param StringValueObject $orderBy
     * @param Order             $sortOrder
     */
    public function __construct(StringValueObject $orderBy, Order $sortOrder)
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
     * @return Order
     */
    public function getSortOrder()
    {
        return $this->sortOrder;
    }
}
