<?php

namespace ThreeDCart\Api\Soap\Resources\Customer;

use ThreeDCart\Api\Soap\Resources\SoapResource;
use ThreeDCart\Api\Soap\Resources\VisitorInterface;

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
