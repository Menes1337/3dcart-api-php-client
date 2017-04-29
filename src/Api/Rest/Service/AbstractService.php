<?php

namespace ThreeDCart\Api\Rest\Service;

use ThreeDCart\Api\Rest\Request\HandlerInterface;

/**
 * Class AbstractService
 *
 * @package ThreeDCart\Api\Rest\Request\Service
 */
class AbstractService
{
    /** @var HandlerInterface */
    protected $requestHandler;
    
    /**
     * @param HandlerInterface $requestHandler
     */
    public function __construct(
        HandlerInterface $requestHandler
    ) {
        $this->requestHandler = $requestHandler;
    }
}
