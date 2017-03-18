<?php

namespace ThreeDCart\Api\Soap\Resource\Customer;

use ThreeDCart\Api\Soap\Resource\SoapResource;
use ThreeDCart\Api\Soap\Resource\VisitorInterface;

/**
 * Class LoginToken
 *
 * @package ThreeDCart\Api\Soap\Resource\Customer
 */
class LoginToken extends SoapResource
{
    /** @var int */
    private $Token;
    
    /**
     * @return int
     */
    public function getToken()
    {
        return $this->Token;
    }
    
    /**
     * @param int $Token
     */
    public function setToken($Token)
    {
        $this->Token = $Token;
    }
    
    public function accept(VisitorInterface $visitor)
    {
        $visitor->visitCustomerLoginToken($this);
    }
}
