<?php

namespace ThreeDCart\Api\Rest\Select;

use ThreeDCart\Primitive\StringValueObject;

abstract class AbstractSelect
{
    /** @var StringValueObject */
    protected $field;
    
    /**
     * @param StringValueObject $field
     */
    public function __construct(StringValueObject $field)
    {
        $this->field = $field;
    }
    
    /**
     * @return StringValueObject
     */
    public function getField()
    {
        return $this->field;
    }
}
