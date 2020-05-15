<?php

namespace ThreeDCart\Api\Rest\Sort;

use ThreeDCart\Primitive\BooleanValueObject;
use ThreeDCart\Primitive\StringValueObject;

interface SortInterface
{
    /**
     * @return StringValueObject
     */
    public function getQueryString();
    
    /**
     * @return BooleanValueObject
     */
    public function isEmpty();
}
