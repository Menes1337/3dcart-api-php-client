<?php

namespace ThreeDCart\Api\Soap\Resource;

use ThreeDCart\Api\Soap\Exception\ParseException;

class ResourceParser implements ResourceParserInterface
{
    /**
     * @param string $className
     * @param array  $objectData
     *
     * @return SoapResource
     * 
     * @throws ParseException
     */
    public function getResource($className, array $objectData)
    {
        if (empty($objectData)) {
            throw new ParseException('unable to create resource. data empty');
        }
        
        /** @var SoapResource $resource */
        $resource = new $className();
        $visitor  = new ResourceParserVisitor($objectData);
        $resource->accept($visitor);
        
        return $resource;
    }
    
    /**
     * @param string $className
     * @param array  $resourcesData
     *
     * @return SoapResource[]
     * 
     * @throws ParseException
     */
    public function getResources($className, array $resourcesData)
    {
        if (empty($resourcesData)) {
            throw new ParseException('unable to create resource. data empty');
        }
        
        $resources = array();
        foreach ($resourcesData as $resourceData) {
            if (empty($resourceData)) {
                throw new ParseException('unable to create resource. data empty');
            }
            $resources[] = $this->getResource($className, $resourceData);
        }
        
        return $resources;
    }
}
