<?php

namespace ThreeDCart\Api\Rest\Api;

use ThreeDCart\Primitive\Enum;

class Version extends Enum
{
    const VERSION_1 = 'v1';
    
    public static $allowedValues = array(self::VERSION_1);
    
    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->getValue();
    }
}
