<?php

namespace ThreeDCart\Api\Rest\Service;

use ThreeDCart\Api\Rest\Request\RequestInterface;

/**
 * Class AbstractService
 *
 * @package ThreeDCart\Api\Rest\Request\Service
 */
class AbstractService
{
    /** @var RequestInterface */
    protected $requestClient;
    
    /**
     * @param RequestInterface $requestClient
     */
    public function __construct(
        RequestInterface $requestClient
    ) {
        $this->requestClient = $requestClient;
    }
}
