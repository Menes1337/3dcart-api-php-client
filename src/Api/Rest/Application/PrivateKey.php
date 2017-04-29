<?php

namespace ThreeDCart\Api\Rest\Application;

use ThreeDCart\Primitive\StringValueObject;

/**
 * Class PrivateKey
 *
 * @package ThreeDCart\Api\Rest\App
 */
class PrivateKey extends StringValueObject
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
