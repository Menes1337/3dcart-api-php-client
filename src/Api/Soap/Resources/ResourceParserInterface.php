<?php

namespace ThreeDCart\Api\Soap\Resources;

interface ResourceParserInterface
{
    public function getResource($className, array $resourceData);
    
    public function getResources($className, array $resourcesData);
}
