<?php

namespace ThreeDCart\Api\Soap\Parameter;

use ThreeDCart\Primitive\Enum;

/**
 * Class CustomerAction
 *
 * @package ThreeDCart\Api\Soap\Parameter
 */
class CustomerAction extends Enum
{
    const INSERT = 'insert';
    const UPDATE = 'update';
    const DELETE = 'delete';
    
    public static $allowedValues = array(self::INSERT, self::UPDATE, self::DELETE);
}
