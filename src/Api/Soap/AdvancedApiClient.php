<?php

namespace ThreeDCart\Api\Soap;

class AdvancedApiClient
{
    const THREEDCART_SOAP_ADVANCED_API_URL = 'http://api.3dcart.com/cart_advanced.asmx';
    
    /** @var string */
    private $threeDCartApiKey;
    /** @var string */
    private $threeDCartStoreUrl;
    /** @var \SoapClient */
    private $soapAdvancedClient;
    /** @var ResponseHandlerInterface */
    private $responseHandler;
    
    /**
     * @param string $threeDCartApiKey
     * @param string $threeDCartStoreUrl
     */
    public function __construct($threeDCartApiKey, $threeDCartStoreUrl)
    {
        $this->threeDCartApiKey   = $threeDCartApiKey;
        $this->threeDCartStoreUrl = $threeDCartStoreUrl;
        
        $this->soapAdvancedClient =
            new \SoapClient(
                static::THREEDCART_SOAP_ADVANCED_API_URL . '?WSDL',
                array(
                    'cache_wsdl'   => WSDL_CACHE_MEMORY,
                    'soap_version' => SOAP_1_2
                )
            );
        $this->responseHandler    = new ResponseHandler();
    }
    
    /**
     * @param string $sql
     * @param string $callBackUrl
     *
     * @return string
     */
    public function runQuery($sql, $callBackUrl = '')
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $response = $this->soapAdvancedClient->runQuery(array(
            'storeUrl'     => $this->threeDCartStoreUrl,
            'userKey'      => $this->threeDCartApiKey,
            'sqlStatement' => $sql,
            'callBackURL'  => $callBackUrl
        ));
        
        return $this->responseHandler->processXMLToArray($response->runQueryResult, 'runQueryRecord');
    }
    
    /**
     * @param array $fields
     *
     * @return string
     */
    public function getCategories(array $fields = array('*'))
    {
        return $this->runQuery('SELECT ' . implode(',', $fields) . ' FROM category');
    }
    
    /**
     * @param ResponseHandlerInterface $responseHandler
     */
    public function setResponseHandler(ResponseHandlerInterface $responseHandler)
    {
        $this->responseHandler = $responseHandler;
    }
}
