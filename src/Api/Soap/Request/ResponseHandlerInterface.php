<?php

namespace ThreeDCart\Api\Soap\Request;

use ThreeDCart\Primitive\ArrayValueObject;
use ThreeDCart\Api\Soap\Response\Xml;

/**
 * Interface ResponseHandlerInterface
 *
 * @package ThreeDCart\Api\Soap\Request
 */
interface ResponseHandlerInterface
{
    /**
     * @param Xml $xml
     *
     * @return ArrayValueObject
     *
     * @throws ResponseInvalidException
     */
    public function convertToArray(Xml $xml);
    
    /**
     * @param Xml              $xmlResponse
     * @param ArrayValueObject $response
     *
     * @throws ResponseInvalidException
     */
    public function handleApiErrors(Xml $xmlResponse, ArrayValueObject $response);
}
