<?php

namespace ThreeDCart\Api\Rest\Shop;

use ThreeDCart\Primitive\StringValueObject;

/**
 * Class SecureUrl
 *
 * @package ThreeDCart\Api\Rest\Shop
 */
class SecureUrl extends StringValueObject
{
    /**
     * @param string $value
     *
     * @throws \InvalidArgumentException
     */
    protected function validate($value)
    {
        parent::validate($value);
        
        if (empty($value)) {
            throw new \InvalidArgumentException('$value can\'t be empty');
        }
    }
}
