<?php

namespace ThreeDCart\Api\Soap\Response;

use ThreeDCart\Primitive\StringValueObject;

/**
 * Class Xml
 *
 * @package ThreeDCart\Api\Soap\Response
 */
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
    public function getXmlAsString()
    {
        return $this->xml;
    }
}
