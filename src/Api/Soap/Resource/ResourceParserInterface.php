<?php

namespace ThreeDCart\Api\Soap\Resource;

use ThreeDCart\Api\Soap\Exception\ParseException;

interface ResourceParserInterface
{
    
    /**
     * @param string $className
     * @param array  $resourceObjectData
     *
     * @return SoapResource
     * 
     * @throws ParseException
     */
    public function getResource($className, array $resourceObjectData);
    
    /**
     * @param string $className
     * @param array  $resourcesData
     *
     * @return SoapResource[]
     *
     * @throws ParseException
     */
    public function getResources($className, array $resourcesData);
}
