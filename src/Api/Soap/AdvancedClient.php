<?php

namespace ThreeDCart\Api\Soap;

use ThreeDCart\Api\Soap\AdvancedClient\Request\MethodsInterface;

class AdvancedClient
{
    /** @var MethodsInterface */
    private $soapAdvancedClient;
    /** @var ResponseHandlerInterface */
    private $responseHandler;
    
    /**
     * @param MethodsInterface         $soapClient
     * @param ResponseHandlerInterface $responseHandler
     */
    public function __construct(MethodsInterface $soapClient, ResponseHandlerInterface $responseHandler)
    {
        $this->soapAdvancedClient = $soapClient;
        $this->responseHandler    = $responseHandler;
    }
    
    /**
     * @param string $sql
     * @param string $callBackUrl
     *
     * @return string
     */
    public function runQuery($sql, $callBackUrl = '')
    {
        $response = $this->soapAdvancedClient->runQuery($sql, $callBackUrl);
        
        return $this->responseHandler->convertXML($response->runQueryResult, 'runQueryRecord');
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
}
