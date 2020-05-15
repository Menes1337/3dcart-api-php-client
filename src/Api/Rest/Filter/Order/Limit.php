<?php

namespace ThreeDCart\Api\Rest\Filter\Order;

use ThreeDCart\Primitive\UnsignedIntegerValueObject;

class Limit extends UnsignedIntegerValueObject
{
    const LIMIT_MINIMUM = 0;
    const LIMIT_MAXIMUM = 500;
    
    /**
     * @param int $value
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($value)
    {
        parent::__construct($value, true);
        
        if ($this->getIntValue() > self::LIMIT_MAXIMUM) {
            throw new \InvalidArgumentException(
                'limit must be between ' . self::LIMIT_MINIMUM . ' and ' . self::LIMIT_MAXIMUM
            );
        }
    }
}
