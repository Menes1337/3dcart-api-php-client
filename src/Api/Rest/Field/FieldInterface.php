<?php

namespace ThreeDCart\Api\Rest\Field;

use ThreeDCart\Primitive\StringValueObject;

interface FieldInterface
{
    /**
     * @return StringValueObject
     */
    public function getStringValueObject();
}
