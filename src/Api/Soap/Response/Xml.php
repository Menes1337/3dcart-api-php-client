<?php

namespace ThreeDCart\Api\Soap\Response;

use ThreeDCart\Primitive\StringValueObject;

class Xml
{
    /** @var StringValueObject */
    private $xml;
    
    /**
     * @param StringValueObject $xml
     */
    public function __construct(StringValueObject $xml)
    {
        $this->xml = $xml;
    }
    
    /**
     * @return StringValueObject
     */
    public function getValue()
    {
        return $this->xml;
    }
}
