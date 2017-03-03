<?php

namespace ThreeDCart\Api\Soap;

use ThreeDCart\Api\Soap\Exception\ApiErrorException;
use ThreeDCart\Api\Soap\Exception\MalFormedApiResponseException;
use ThreeDCart\Api\Soap\Exception\ResponseBodyEmptyException;

interface ResponseHandlerInterface
{
    /**
     * This method gets a \stdClass object as a result of a SOAP operation and
     * will return the received data as an array or string
     *
     * @param \stdClass $soapResponse
     * @param string    $responseXmlTag
     *
     * @return array | string
     *
     * @throws MalFormedApiResponseException
     * @throws ApiErrorException
     * @throws ResponseBodyEmptyException
     */
    public function convertXML(\stdClass $soapResponse, $responseXmlTag = null);
}
