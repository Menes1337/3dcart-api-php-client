<?php

namespace ThreeDCart\Api\Soap\Resources;

use ThreeDCart\Api\Soap\Exceptions\ParseException;

class ResourceParser implements ResourceParserInterface
{
    
    /**
     * @param string $className
     * @param array  $data
     *
     * @return SoapResource
     * @throws ParseException
     */
    public function getResource($className, array $data)
    {
        if (empty($data)) {
            throw new ParseException('unable to create resource. data empty');
        }
        
        /** @var SoapResource $resource */
        $resource = new $className();
        $visitor  = new ResourceParserVisitor($data);
        $resource->accept($visitor);
        
        return $resource;
    }
    
    /**
     * @param string $className
     * @param array  $resourcesData
     *
     * @return SoapResource[]
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
