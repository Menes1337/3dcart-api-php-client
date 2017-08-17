<?php

namespace ThreeDCart\Api\Rest\Filter;

use ThreeDCart\Api\Rest\Request\HttpParameterList;
use ThreeDCart\Primitive\BooleanValueObject;
use ThreeDCart\Primitive\IntegerValueObject;

/**
 * @package ThreeDCart\Api\Rest\Filter
 */
interface FilterListInterface
{
    /**
     * @return HttpParameterList
     */
    public function getHttpParameterList();
    
    /**
     * @post the filter will have no active entries
     */
    public function clear();
    
    /**
     * @return BooleanValueObject will return whether the filter has active entries or not
     */
    public function isEmpty();
    
    /**
     * @return IntegerValueObject will return the number of active entries in the filter
     */
    public function count();
}
