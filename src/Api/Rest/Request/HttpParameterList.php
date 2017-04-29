<?php

namespace ThreeDCart\Api\Rest\Request;

use ThreeDCart\Primitive\BooleanValueObject;
use ThreeDCart\Primitive\IntegerValueObject;
use ThreeDCart\Primitive\StringValueObject;

class HttpParameterList
{
    /** @var HttpParameter[] */
    private $list;
    
    public function __construct()
    {
        $this->list = [];
    }
    
    /**
     * @param HttpParameter $httpParameter
     */
    public function addParameter(HttpParameter $httpParameter)
    {
        $this->list[] = $httpParameter;
    }
    
    public function clear()
    {
        $this->list = [];
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
    
    /**
     * @return BooleanValueObject
     */
    public function isEmpty()
    {
        return new BooleanValueObject(empty($this->list));
    }
    
    /**
     * @return IntegerValueObject
     */
    public function count()
    {
        return new IntegerValueObject(count($this->list));
    }
}
