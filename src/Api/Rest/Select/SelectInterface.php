<?php

namespace ThreeDCart\Api\Rest\Select;

use ThreeDCart\Primitive\BooleanValueObject;
use ThreeDCart\Primitive\StringValueObject;

interface SelectInterface
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
