<?php

namespace ThreeDCart\Api\Rest;

use ThreeDCart\Api\Rest\Authentication\HttpHeader;

/**
 * Class AuthenticationServiceInterfaces
 *
 * @package ThreeDCart\Api\Rest
 */
interface AuthenticationServiceInterface
{
    /**
     * @return HttpHeader
     */
    public function getHttpHeaders();
}
