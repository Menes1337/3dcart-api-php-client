<?php

namespace ThreeDCart\Primitive;

abstract class AbstractList
{
    /** @var array */
    protected $list;
    
    public function __construct()
    {
        $this->list = [];
    }
    
    /**
     * @param mixed $entry
     */
    protected function addEntry($entry)
    {
        $this->list[] = $entry;
    }
    
    public function clear()
    {
        $this->list = [];
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
