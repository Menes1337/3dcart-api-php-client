<?php

namespace ThreeDCart\Api\Rest\Select;

use ThreeDCart\Primitive\StringValueObject;

interface SelectInterface
{
    /**
     * @return StringValueObject
     */
    public function getField();
}
