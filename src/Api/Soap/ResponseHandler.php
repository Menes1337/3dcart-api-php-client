<?php

namespace ThreeDCart\Api\Soap;

use ThreeDCart\Api\Soap\Exception\MalFormedApiResponseException;
use ThreeDCart\Api\Soap\Exception\ResponseBodyEmptyException;
use ThreeDCart\Api\Soap\Exception\ApiErrorException;
use ThreeDCart\Api\Soap\Xml\SimpleXmlExceptionRenderer;

class ResponseHandler implements ResponseHandlerInterface
{
    /** @var SimpleXmlExceptionRenderer */
    private $simpleXmlExceptionRenderer;
    
    /**
     * @param SimpleXmlExceptionRenderer $simpleXmlExceptionRenderer
     */
    public function __construct(SimpleXmlExceptionRenderer $simpleXmlExceptionRenderer)
    {
        $this->simpleXmlExceptionRenderer = $simpleXmlExceptionRenderer;
    }
    
    /**
     * @param \stdClass     $soapResponse
     * @param string | null $responseXmlTag
     *
     * @throws ResponseBodyEmptyException
     * @throws ApiErrorException
     * @throws MalFormedApiResponseException
     *
     * @return array | string
     */
    public function convertXML(\stdClass $soapResponse, $responseXmlTag = null)
    {
        $this->checkEmptyResponse($soapResponse);
        
        $simpleXML = $this->convertResponseIntoSimpleXMLElement($soapResponse);
        
        $resultAsArray = $this->XMLToArray($simpleXML);
        
        $this->handleApiErrors($soapResponse, $resultAsArray);
        
        if ($responseXmlTag !== null) {
            return $this->extractSpecificXmlTag($responseXmlTag, $resultAsArray);
        }
        
        return $resultAsArray;
    }
    
    /**
     * @param \SimpleXMLElement $xml
     *
     * @return array
     */
    protected function XMLToArray(\SimpleXMLElement $xml)
    {
        $resultArray = json_decode(json_encode((array)$xml));
        
        return (array)$this->convertEmptyStdClassToNull($resultArray);
    }
    
    /**
     * @param array|\stdClass $object
     *
     * @return mixed
     */
    protected function convertEmptyStdClassToNull($object)
    {
        if ($object instanceof \stdClass && count((array)$object) == 0) {
            return null;
        } else {
            if (is_object($object) || is_array($object)) {
                foreach ($object as $key => &$value) {
                    $value = $this->convertEmptyStdClassToNull($value);
                }
                
                return (array)$object;
            }
        }
        
        return $object;
    }
    
    /**
     * @param \stdClass $response
     *
     * @return \SimpleXMLElement
     * @throws MalFormedApiResponseException
     */
    protected function convertResponseIntoSimpleXMLElement(\stdClass $response)
    {
        try {
            libxml_use_internal_errors(true);
            libxml_clear_errors();
            $simpleXML = new \SimpleXMLElement($response->any, LIBXML_NOCDATA);
            
            return $simpleXML;
        } catch (\Exception $ex) {
            throw new MalFormedApiResponseException(
                $this->simpleXmlExceptionRenderer->getErrorMessage($this->getLibXMLErrors()),
                $response->any
            );
        }
    }
    
    /**
     * @return array
     */
    protected function getLibXMLErrors()
    {
        $libXMLErrors = libxml_get_errors();
        libxml_clear_errors();
        
        return $libXMLErrors;
    }
    
    /**
     * @param \stdClass $response
     *
     * @throws ResponseBodyEmptyException
     */
    protected function checkEmptyResponse(\stdClass $response)
    {
        if (empty($response) || empty($response->any)) {
            throw new ResponseBodyEmptyException('response body is empty', '');
        }
    }
    
    /**
     * @param \stdClass $soapResponse
     * @param array     $resultAsArray
     *
     * @throws ApiErrorException
     */
    protected function handleApiErrors(\stdClass $soapResponse, array $resultAsArray)
    {
        if (isset($resultAsArray['Id']) && isset($resultAsArray['Description'])) {
            throw new ApiErrorException($resultAsArray['Description'], $resultAsArray['Id'], $soapResponse->any);
        }
        
        if (isset($resultAsArray['Error']['Id']) && isset($resultAsArray['Error']['Description'])) {
            throw new ApiErrorException($resultAsArray['Error']['Description'], $resultAsArray['Error']['Id'],
                $soapResponse->any);
        }
        
        if (strpos($soapResponse->any, '<Error') === 0) {
            throw new ApiErrorException(substr($soapResponse->any, 0, 500), null, $soapResponse->any);
        }
    }
    
    /**
     * @param string $responseXmlTag
     * @param array  $result
     *
     * @return string | array
     *
     * @throws MalFormedApiResponseException
     */
    protected function extractSpecificXmlTag($responseXmlTag, array $result)
    {
        if (!isset($result[$responseXmlTag])) {
            throw new MalFormedApiResponseException('xml tag ' . $responseXmlTag . ' is missing');
        }
        $result = $result[$responseXmlTag];
        
        return $result;
    }
}
