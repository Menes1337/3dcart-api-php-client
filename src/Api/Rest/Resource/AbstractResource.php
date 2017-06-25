<?php

namespace ThreeDCart\Api\Rest\Resource;

abstract class AbstractResource
{
    protected static $lists   = [];
    protected static $objects = [];
    
    /**
     * @param array $data
     *
     * @return AbstractResource
     */
    public static function fromArray(array $data)
    {
        $self = new static();
        
        foreach ($data as $field => $value) {
            $self->{$field} = $value;
        }
        
        return $self;
    }
    
    /**
     * @param array $list
     *
     * @return AbstractResource[]
     */
    public static function fromList(array $list)
    {
        $resources = [];
        
        foreach ($list as $item) {
            $resources[] = self::fromArray($item);
        }
        
        return $resources;
    }
}
