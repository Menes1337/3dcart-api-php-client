<?php

namespace ThreeDCart\Primitive;

/**
 * Class StringValueObject
 *
 * @package ThreeDCart\Primitive
 */
class StringValueObject
{
    /** @var string */
    private $value;
    
    /**
     * @param string $value
     */
    public function __construct($value)
    {
        if (!is_string($value)) {
            throw new \InvalidArgumentException(
                'parameter $value is not of type string. type is ' . gettype($value)
            );
        }
        $this->value = $value;
    }
    
    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}
