<?php

namespace ThreeDCart\Api\Soap\AdvancedClient\Request;

class PhpDefault extends \SoapClient implements MethodsInterface
{
    const THREEDCART_SOAP_API_URL = 'http://api.3dcart.com/cart_advanced.asmx';
    
    /** @var string */
    private $threeDCartApiKey;
    /** @var string */
    private $threeDCartStoreUrl;
    
    /**
     * @param string $threeDCartStoreUrl
     * @param string $threeDCartApiKey
     */
    public function __construct($threeDCartStoreUrl, $threeDCartApiKey)
    {
        $this->threeDCartStoreUrl = $threeDCartStoreUrl;
        $this->threeDCartApiKey   = $threeDCartApiKey;
        
        parent::__construct(self::THREEDCART_SOAP_API_URL . '?WSDL',
            array(
                'cache_wsdl'   => WSDL_CACHE_MEMORY,
                'soap_version' => SOAP_1_2
            ));
    }
    
    /**
     * @param string $sql
     * @param string $callBackUrl
     *
     * @return \stdClass $stdClass has property runQueryResult
     */
    public function runQuery($sql, $callBackUrl = '')
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return parent::runQuery(array(
            'storeUrl'     => $this->threeDCartStoreUrl,
            'userKey'      => $this->threeDCartApiKey,
            'sqlStatement' => $sql,
            'callBackURL'  => $callBackUrl
        ));
    }
}
