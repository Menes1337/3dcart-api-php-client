<?php

namespace ThreeDCart\Api\Rest\Select;

use ThreeDCart\Primitive\BooleanValueObject;
use ThreeDCart\Primitive\StringValueObject;

interface SelectListInterface
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
