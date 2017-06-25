<?php

namespace ThreeDCart\Api\Rest\Field;

use ThreeDCart\Primitive\Enum;
use ThreeDCart\Primitive\StringValueObject;

abstract class AbstractField extends Enum implements FieldInterface
{
    /**
     * @return StringValueObject
     */
    public function getStringValueObject()
    {
        return new StringValueObject(parent::getValue());
    }
}
