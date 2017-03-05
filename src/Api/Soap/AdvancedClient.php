<?php

namespace ThreeDCart\Api\Soap;

use ThreeDCart\Api\Soap\Request\AdvancedClientInterface;
use ThreeDCart\Api\Soap\Request\MalFormedApiResponseException;
use ThreeDCart\Api\Soap\Request\ResponseInvalidException;
use ThreeDCart\Api\Soap\Request\SqlFieldList;
use ThreeDCart\Api\Soap\Request\ResponseHandlerInterface;
use ThreeDCart\Primitive\ArrayValueObject;
use ThreeDCart\Primitive\StringValueObject;

/**
 * Class AdvancedClient
 *
 * @package ThreeDCart\Api\Soap
 */
class AdvancedClient
{
    const THREEDCART_SOAP_API_URL = 'http://api.3dcart.com/cart_advanced.asmx';
    const RUN_QUERY_RECORD        = 'runQueryRecord';
    
    /** @var AdvancedClientInterface */
    private $soapAdvancedClient;
    /** @var ResponseHandlerInterface */
    private $responseHandler;
    
    /**
     * @param AdvancedClientInterface  $advancedSoapClient
     * @param ResponseHandlerInterface $responseHandler
     */
    public function __construct(
        AdvancedClientInterface $advancedSoapClient,
        ResponseHandlerInterface $responseHandler
    ) {
        $this->soapAdvancedClient = $advancedSoapClient;
        $this->responseHandler    = $responseHandler;
    }
    
    /**
     * @param StringValueObject $sql
     * @param StringValueObject $callBackUrl
     *
     * @return ArrayValueObject
     *
     * @throws ResponseInvalidException
     */
    public function runQuery(StringValueObject $sql, StringValueObject $callBackUrl = null)
    {
        $responseXml = $this->soapAdvancedClient->runQuery($sql, $callBackUrl);
        
        $objectData = $this->responseHandler->convertToArray($responseXml);
        $this->responseHandler->handleApiErrors($responseXml, $objectData);
        
        return $this->extractSpecificXmlTagAsArray(new StringValueObject(self::RUN_QUERY_RECORD), $objectData);
    }
    
    /**
     * @param SqlFieldList $sqlFieldList
     *
     * @return string
     */
    public function getCategories(SqlFieldList $sqlFieldList)
    {
        return $this->runQuery(
            new StringValueObject(
                'SELECT ' . $sqlFieldList->toString()->getValue() . ' FROM category'
            )
        );
    }
    
    /**
     * @param StringValueObject $responseXmlTag
     * @param ArrayValueObject  $apiResponse
     *
     * @return ArrayValueObject
     *
     * @throws MalFormedApiResponseException
     */
    protected function extractSpecificXmlTagAsArray(StringValueObject $responseXmlTag, ArrayValueObject $apiResponse)
    {
        $arrResponse = $apiResponse->getValue();
        if (!isset($arrResponse[$responseXmlTag->getValue()])) {
            throw new MalFormedApiResponseException('xml tag ' . $responseXmlTag->getValue() . ' is missing');
        }
        
        return new ArrayValueObject($arrResponse[$responseXmlTag->getValue()]);
    }
}
