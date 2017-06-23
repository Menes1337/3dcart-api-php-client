<?php

namespace ThreeDCart\Api\Rest\Request;

use ThreeDCart\Primitive\AbstractList;
use ThreeDCart\Primitive\StringValueObject;

class HttpParameterList extends AbstractList
{
    /** @var HttpParameter[] */
    protected $list;
    
    /**
     * @param HttpParameter $httpParameter
     */
    public function addParameter(HttpParameter $httpParameter)
    {
        $this->addEntry($httpParameter);
    }
    
    /**
     * @return array [string, string]
     */
    public function getSimpleParameterArray()
    {
        $parameters = [];
        foreach ($this->list as $parameter) {
            $parameters[$parameter->getParameterKey()->getStringValue()] =
                $parameter->getParameterValue()->getStringValue();
        }
        
        return $parameters;
    }
    
    /**
     * @return StringValueObject
     */
    public function buildHttpQuery()
    {
        return new StringValueObject(http_build_query($this->getSimpleParameterArray()));
    }
}
