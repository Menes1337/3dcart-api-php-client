<?php

namespace ThreeDCart\Api\Soap\AdvancedClient\Request;

interface MethodsInterface
{
    /**
     * @param string $threeDCartStoreUrl
     * @param string $threeDCartApiKey
     */
    public function __construct($threeDCartStoreUrl, $threeDCartApiKey);
    
    /**
     * @param string $sql
     * @param string $callBackUrl
     *
     * @return \stdClass $stdClass has property runQueryResult
     */
    public function runQuery($sql, $callBackUrl = '');
}
