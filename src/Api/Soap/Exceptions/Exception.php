<?php

namespace ThreeDCart\Api\Soap\Exceptions;

class Exception extends \Exception
{
    /** @var string */
    private $xmlResponse;
    
    public function __construct($message, $xmlResponse = '', Exception $previous = null)
    {
        $this->xmlResponse = $xmlResponse;
        
        parent::__construct($message, 0, $previous);
    }
    
    /**
     * @return string
     */
    public function getXmlResponse()
    {
        return $this->xmlResponse;
    }
}
