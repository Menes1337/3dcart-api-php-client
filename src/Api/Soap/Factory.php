<?php

namespace ThreeDCart\Api\Soap;

use ThreeDCart\Api\Soap\Client\Request\PhpDefault;
use ThreeDCart\Api\Soap\Resource\ResourceParser;
use ThreeDCart\Api\Soap\AdvancedClient\Request\PhpDefault as AdvancedPhpDefault;
use ThreeDCart\Api\Soap\Xml\SimpleXmlExceptionRenderer;

class Factory
{
    /**
     * @param string $threeDCartApiKey
     * @param string $threeDCartStoreUrl
     *
     * @return Client
     */
    public function getApiClient($threeDCartApiKey, $threeDCartStoreUrl)
    {
        return new Client(
            new PhpDefault($threeDCartStoreUrl, $threeDCartApiKey),
            new ResponseHandler(new SimpleXmlExceptionRenderer()),
            new ResourceParser());
    }
    
    /**
     * @param string $threeDCartApiKey
     * @param string $threeDCartStoreUrl
     *
     * @return AdvancedClient
     */
    public function getAdvancedApiClient($threeDCartApiKey, $threeDCartStoreUrl)
    {
        return new AdvancedClient(
            new AdvancedPhpDefault($threeDCartStoreUrl, $threeDCartApiKey),
            new ResponseHandler(new SimpleXmlExceptionRenderer())
        );
    }
    
}
