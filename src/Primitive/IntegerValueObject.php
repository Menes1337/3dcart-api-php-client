<?php

namespace ThreeDCart\Primitive;

/**
 * Class IntegerValueObject
 *
 * @package ThreeDCart\Primitive
 */
class IntegerValueObject
{
    /** @var int */
    private $value;
    
    /**
     * @param int $value
     */
    public function __construct($value)
    {
        $intValue = (int)$value;
        
        if (((String)$intValue) != (String)$value) {
            throw new \InvalidArgumentException(
                'parameter $value is not of type int. type is ' . gettype($value)
            );
        }
        
        $this->value = $intValue;
    }
    
    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }
}
