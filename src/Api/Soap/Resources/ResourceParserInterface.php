<?php

namespace ThreeDCart\Api\Soap\Resources;

interface ResourceParserInterface
{
    public function getResourceFromArray($className, array $resource);
}
