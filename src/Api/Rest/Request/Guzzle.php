<?php

namespace ThreeDCart\Api\Rest\Request;

use GuzzleHttp\ClientInterface;
use ThreeDCart\Api\Rest\AuthenticationServiceInterface;
use ThreeDCart\Primitive\StringValueObject;

class Guzzle implements RequestInterface
{
    const OPTION_HEADERS     = 'headers';
    const OPTION_VERIFY      = 'verify';
    const OPTION_FORM_PARAMS = 'form_params';
    
    /** @var ClientInterface */
    private $requestClient;
    
    /** @var AuthenticationServiceInterface */
    private $authenticationService;
    
    /**
     * @param ClientInterface                $requestClient
     * @param AuthenticationServiceInterface $authenticationService
     */
    public function __construct(ClientInterface $requestClient, AuthenticationServiceInterface $authenticationService)
    {
        $this->requestClient         = $requestClient;
        $this->authenticationService = $authenticationService;
    }
    
    public function send(
        HttpMethod $httpMethod,
        ApiPathAppendix $apiPathAppendix,
        HttpParameterList $httpGetParameterList,
        HttpParameterList $httpPostParameterList
    ) {
        $response = $this->requestClient->request(
            $httpMethod->getMethod(),
            $this->getUrl($apiPathAppendix, $httpGetParameterList)->getStringValue(),
            $this->getGuzzleOptions($httpPostParameterList)
        );
        
        return new StringValueObject($response->getBody()->getContents());
    }
    
    /**
     * @param HttpParameterList $httpPostList
     *
     * @return array
     */
    private function getGuzzleOptions(HttpParameterList $httpPostList)
    {
        $guzzleOptions = [
            self::OPTION_HEADERS => $this->authenticationService->getHttpHeaders()->getValue(),
            self::OPTION_VERIFY  => false
        ];
        
        if (!$httpPostList->isEmpty()->getBoolValue()) {
            $guzzleOptions[self::OPTION_FORM_PARAMS] = $httpPostList->getSimpleParameterArray();
        }
        
        return $guzzleOptions;
    }
    
    /**
     * @param ApiPathAppendix   $apiPathAppendix
     * @param HttpParameterList $httpGetParameterList
     *
     * @return StringValueObject
     */
    private function getUrl(ApiPathAppendix $apiPathAppendix, HttpParameterList $httpGetParameterList)
    {
        $url = $apiPathAppendix;
        if (!$httpGetParameterList->isEmpty()->getBoolValue()) {
            $url = new StringValueObject(
                $url->getStringValue() . '?' . $httpGetParameterList->buildHttpQuery()->getStringValue()
            );
        }
        
        return $url;
    }
}
