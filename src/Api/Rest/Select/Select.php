<?php

namespace ThreeDCart\Api\Rest\Select;

use ThreeDCart\Api\Rest\Field\FieldInterface;
use ThreeDCart\Primitive\StringValueObject;

class Select
{
    /** @var StringValueObject */
    protected $field;
    
    /**
     * @param FieldInterface $field
     */
    public function __construct(FieldInterface $field)
    {
        $this->field = $field->getStringValueObject();
    }
    
    /**
     * @return StringValueObject
     */
    public function getField()
    {
        return $this->field;
    }
}
