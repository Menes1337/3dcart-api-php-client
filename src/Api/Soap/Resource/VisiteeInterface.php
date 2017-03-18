<?php

namespace ThreeDCart\Api\Soap\Resource;

/**
 * Interface VisiteeInterface
 *
 * @package ThreeDCart\Api\Soap\Resource
 */
interface VisiteeInterface
{
    public function accept(VisitorInterface $visitor);
}
