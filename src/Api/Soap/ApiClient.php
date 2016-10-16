<?php

namespace ThreeDCart\Api\Soap;

class ApiClient
{
    const THREEDCART_SOAP_API_URL = 'http://api.3dcart.com/cart.asmx';
    
    /** @var string */
    private $threeDCartApiKey;
    /** @var string */
    private $threeDCartStoreUrl;
    /** @var \SoapClient */
    private $soapClient;
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
        
        $this->soapClient      =
            new \SoapClient(
                static::THREEDCART_SOAP_API_URL . '?WSDL',
                array(
                    'cache_wsdl'   => WSDL_CACHE_MEMORY,
                    'soap_version' => SOAP_1_2
                )
            );
        $this->responseHandler = new ResponseHandler();
    }
    
    /**
     * @param int    $batchSize
     * @param int    $startNum
     * @param string $productId
     * @param string $callBackUrl
     * 
     * @return array
     */
    public function getProduct($batchSize = 100, $startNum = 1, $productId = '', $callBackUrl = '')
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $response = $this->soapClient->getProduct(array(
            'storeUrl'    => $this->threeDCartStoreUrl,
            'userKey'     => $this->threeDCartApiKey,
            'batchSize'   => $batchSize,
            'startNum'    => $startNum,
            'productId'   => $productId,
            'callBackURL' => $callBackUrl
        ));
        
        return $this->responseHandler->processXMLToArray($response->getProductResult, 'Product');
    }
    
    /**
     * @param ResponseHandlerInterface $responseHandler
     */
    public function setResponseHandler(ResponseHandlerInterface $responseHandler)
    {
        $this->responseHandler = $responseHandler;
    }
    
    
}
