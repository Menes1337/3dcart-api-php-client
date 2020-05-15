<?php

namespace ThreeDCart\Api\Rest\Filter;

use ThreeDCart\Api\Rest\Filter\Category\Limit;
use ThreeDCart\Primitive\BooleanValueObject;
use ThreeDCart\Primitive\StringValueObject;
use ThreeDCart\Primitive\UnsignedIntegerValueObject;

/**
 * @package ThreeDCart\Api\Rest\Filter
 */
interface CategoryFilterListInterface extends FilterListInterface
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
     * @param StringValueObject $categoryName
     */
    public function filterCategory(StringValueObject $categoryName);
    
    /**
     * @param BooleanValueObject $countOnly
     */
    public function filterCountOnly(BooleanValueObject $countOnly);
}
