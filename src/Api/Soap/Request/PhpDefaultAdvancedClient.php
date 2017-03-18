<?php

namespace ThreeDCart\Api\Soap\Request;

use ThreeDCart\Api\Soap\Response\Xml;
use ThreeDCart\Primitive\StringValueObject;

/**
 * Class PhpDefaultAdvancedClient
 *
 * @package ThreeDCart\Api\Soap\Request
 */
class PhpDefaultAdvancedClient implements AdvancedClientInterface
{
    /** @var StringValueObject */
    private $threeDCartApiKey;
    /** @var StringValueObject */
    private $threeDCartStoreUrl;
    /** @var \SoapClient */
    private $soapClient;
    
    /**
     * @param \SoapClient       $soapClient
     * @param StringValueObject $threeDCartStoreUrl
     * @param StringValueObject $threeDCartApiKey
     */
    public function __construct(
        \SoapClient $soapClient,
        StringValueObject $threeDCartStoreUrl,
        StringValueObject $threeDCartApiKey
    ) {
        $this->soapClient         = $soapClient;
        $this->threeDCartStoreUrl = $threeDCartStoreUrl;
        $this->threeDCartApiKey   = $threeDCartApiKey;
    }
    
    public function runQuery(StringValueObject $sql, StringValueObject $callBackUrl = null)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $soapResponse = $this->soapClient->runQuery(array(
            'storeUrl'     => $this->threeDCartStoreUrl->getValue(),
            'userKey'      => $this->threeDCartApiKey->getValue(),
            'sqlStatement' => $sql->getValue(),
            'callBackURL'  => is_null($callBackUrl) ? '' : $callBackUrl->getValue()
        ));
        
        $this->checkEmptyResponse($soapResponse);
        
        return new Xml(new StringValueObject($soapResponse));
    }
    
    /**
     * @param \stdClass $response
     *
     * @throws ResponseBodyEmptyException
     */
    public function checkEmptyResponse(\stdClass $response)
    {
        if (empty($response) || empty($response->any)) {
            throw new ResponseBodyEmptyException('response body is empty', null);
        }
    }
}
