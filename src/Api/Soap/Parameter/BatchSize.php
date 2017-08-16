<?php

namespace ThreeDCart\Api\Soap\Parameter;

use ThreeDCart\Primitive\UnsignedIntegerValueObject;

/**
 * Class BatchSize
 *
 * @package ThreeDCart\Api\Soap\Parameter
 */
class BatchSize extends UnsignedIntegerValueObject
{
    /**
     * @param int $value
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($value)
    {
        parent::__construct($value, false);
        
        if ($this->getValue() > 100) {
            throw new \InvalidArgumentException('parameter must be between 1 and 100');
        }
    }
}
