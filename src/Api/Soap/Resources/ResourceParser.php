<?php

namespace ThreeDCart\Api\Soap\Resources;

use ThreeDCart\Api\Soap\Exceptions\ParseException;

class ResourceParser implements ResourceParserInterface
{
    public function getResourceFromArray($className, array $data)
    {
        if (empty($data)) {
            throw new ParseException('unable to create resource. data empty');
        }
        
        /** @var SoapResource $resource */
        $resource = new $className();
        
        foreach ($data as $key => $value) {
            if (!method_exists($resource, 'get' . $key)) {
                throw new ParseException('unable to create resource. key ' . $key . ' don\'t exist');
            }
        }
    }
}
