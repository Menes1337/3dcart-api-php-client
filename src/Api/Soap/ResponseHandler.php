<?php

namespace ThreeDCart\Api\Soap;

use ThreeDCart\Api\Soap\Exceptions\MalFormedApiResponseException;
use ThreeDCart\Api\Soap\Exceptions\ResponseBodyEmptyException;
use ThreeDCart\Api\Soap\Exceptions\ApiErrorException;
use ThreeDCart\Api\Soap\Xml\SimpleXmlExceptionRenderer;

class ResponseHandler implements ResponseHandlerInterface
{
    /**
     * @param \stdClass $response
     * @param string    $responseXmlTag
     *
     * @throws ResponseBodyEmptyException
     * @throws ApiErrorException
     * @throws MalFormedApiResponseException
     *
     * @return array
     */
    public function processXMLToArray(\stdClass $response, $responseXmlTag)
    {
        if (empty($response) || empty($response->any)) {
            throw new ResponseBodyEmptyException('response body is empty', '');
        }
        
        $simpleXML = $this->handleErrorMessages($response);
        
        $result = json_decode(json_encode((array)$simpleXML), true);
        
        if (isset($result['Id']) && isset($result['Description'])) {
            throw new ApiErrorException($result['Description'], $result['Id'], $response->any);
        }
        
        if (isset($result['Error']['Id']) && isset($result['Error']['Description'])) {
            throw new ApiErrorException($result['Error']['Description'], $result['Error']['Id'], $response->any);
        }
        
        if (!isset($result[$responseXmlTag])) {
            throw new MalFormedApiResponseException('xml tag ' . $responseXmlTag . ' is missing');
        }
        
        return $result[$responseXmlTag];
    }
    
    /**
     * @param \stdClass $response
     *
     * @return \SimpleXMLElement
     * @throws MalFormedApiResponseException
     */
    protected function handleErrorMessages(\stdClass $response)
    {
        try {
            libxml_use_internal_errors(true);
            libxml_clear_errors();
            $simpleXML = new \SimpleXMLElement($response->any);
            
            if (!empty(($errors = libxml_get_errors()))) {
                $SimpleXmlExceptionRenderer = new SimpleXmlExceptionRenderer($errors);
                throw new MalFormedApiResponseException($SimpleXmlExceptionRenderer->getErrorMessage(), $response->any);
            }
            
            return $simpleXML;
        } catch (\Exception $ex) {
            $errors                     = libxml_get_errors();
            $SimpleXmlExceptionRenderer = new SimpleXmlExceptionRenderer($errors);
            throw new MalFormedApiResponseException($SimpleXmlExceptionRenderer->getErrorMessage(), $response->any);
        }
    }
}
