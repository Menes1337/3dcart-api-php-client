<?php

namespace ThreeDCart\Primitive;

/**
 * Class UnsignedIntegerValueObject
 *
 * @package ThreeDCart\Primitive
 */
class UnsignedIntegerValueObject extends IntegerValueObject
{
    /**
     * @param int  $value
     * @param bool $allowZero
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($value, $allowZero = true)
    {
        parent::__construct($value);
        
        if (!$allowZero && $this->getValue() === 0) {
            throw new \InvalidArgumentException(
                'Zero as value is not allowed'
            );
        }
        
        if ($this->getValue() < 0) {
            throw new \InvalidArgumentException(
                'the passed integer is negative '
            );
        }
    }
}
