<?php

namespace ThreeDCart\Api\Rest;

use GuzzleHttp\Client;
use ThreeDCart\Api\Rest\Api\Service;
use ThreeDCart\Api\Rest\Api\Version;
use ThreeDCart\Api\Rest\Application\PrivateKey;
use ThreeDCart\Api\Rest\Request\Handler\Guzzle;
use ThreeDCart\Api\Rest\Service\Customers;
use ThreeDCart\Api\Rest\Service\CustomersInterface;
use ThreeDCart\Api\Rest\Shop\SecureUrl;
use ThreeDCart\Api\Rest\Shop\Token;

/**
 * Class Factory
 *
 * @package ThreeDCart\Api\Rest
 */
class Factory
{
    const THREEDCART_SOAP_API_URL = 'https://apirest.3dcart.com/3dCartWebAPI/';
    
    /**
     * @param PrivateKey $privateKey
     * @param Token      $token
     * @param SecureUrl  $secureUrl
     *
     * @return AuthenticationServiceInterface
     */
    public function getAuthenticationService(PrivateKey $privateKey, Token $token, SecureUrl $secureUrl)
    {
        return new AuthenticationService($privateKey, $token, $secureUrl);
    }
    
    /**
     * @param AuthenticationServiceInterface $authenticationService
     * @param Version                        $apiVersion
     *
     * @return CustomersInterface
     */
    public function getCustomerService(AuthenticationServiceInterface $authenticationService, Version $apiVersion)
    {
        return new Customers(
            new Guzzle(
                new Client([
                    'base_uri' => self::THREEDCART_SOAP_API_URL . $apiVersion->getValue() . '/' . Service::CUSTOMERS
                        . '/'
                ]),
                $authenticationService
            )
        );
    }
}
