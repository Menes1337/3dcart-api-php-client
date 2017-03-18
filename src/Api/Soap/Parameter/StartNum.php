<?php

namespace ThreeDCart\Api\Soap\Parameter;

use ThreeDCart\Primitive\UnsignedIntegerValueObject;

/**
 * Class StartNum
 *
 * @package ThreeDCart\Api\Soap\Parameter
 */
class StartNum extends UnsignedIntegerValueObject
{
    /**
     * @param int $value
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($value)
    {
        parent::__construct($value, false);
    }
}
