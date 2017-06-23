<?php

namespace ThreeDCart\Api\Rest\Select;

class Customer extends AbstractSelect
{
    /**
     * @param \ThreeDCart\Api\Rest\Field\Customer $field
     */
    public function __construct(\ThreeDCart\Api\Rest\Field\Customer $field)
    {
        parent::__construct($field->getStringValue());
    }
}
