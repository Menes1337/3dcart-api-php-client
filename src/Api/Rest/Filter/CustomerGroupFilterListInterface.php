<?php

namespace ThreeDCart\Api\Rest\Filter;

use ThreeDCart\Api\Rest\Filter\CustomerGroup\Limit;
use ThreeDCart\Primitive\BooleanValueObject;
use ThreeDCart\Primitive\UnsignedIntegerValueObject;

/**
 * @package ThreeDCart\Api\Rest\Filter
 */
interface CustomerGroupFilterListInterface extends FilterListInterface
{
    /**
     * @param Limit $limit
     */
    public function filterLimit(Limit $limit);
    
    /**
     * @param UnsignedIntegerValueObject $offset
     */
    public function filterOffset(UnsignedIntegerValueObject $offset);
    
    /**
     * @param BooleanValueObject $countOnly
     */
    public function filterCountOnly(BooleanValueObject $countOnly);
}
