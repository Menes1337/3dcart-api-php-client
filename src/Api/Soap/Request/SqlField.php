<?php

namespace ThreeDCart\Api\Soap\Request;

use ThreeDCart\Primitive\StringValueObject;

/**
 * Class SqlField
 *
 * @package ThreeDCart\Api\Soap\Request
 */
class SqlField
{
    /** @var StringValueObject */
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
