<?php

namespace ThreeDCart\Api\Soap;

interface ResponseHandlerInterface
{
    /**
     * This method gets a \stdClass object as a result of a SOAP operation and will return data or throw
     * exceptions if it was not a valid response
     *
     * @param \stdClass $response
     * @param string    $responseXmlTag
     *
     * @return array
     */
    public function processXMLToArray(\stdClass $response, $responseXmlTag);
}
