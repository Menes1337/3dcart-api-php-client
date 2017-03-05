<?php

namespace ThreeDCart\Api\Soap\Request;

use ThreeDCart\Primitive\StringValueObject;

class SqlField
{
    private $name;
    
    /**
     * @param StringValueObject $fieldName
     */
    public function __construct(StringValueObject $fieldName)
    {
        $this->name = $fieldName;
    }
    
    /**
     * @return StringValueObject
     */
    public function getName()
    {
        return $this->name;
    }
}
