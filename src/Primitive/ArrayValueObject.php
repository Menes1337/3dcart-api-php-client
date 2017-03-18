<?php

namespace ThreeDCart\Primitive;

/**
 * Class ArrayValueObject
 *
 * @package ThreeDCart\Primitive
 */
class ArrayValueObject
{
    /** @var array */
    private $value;
    
    /**
     * @param array $value
     */
    public function __construct(array $value)
    {
        $this->value = $value;
    }
    
    /**
     * @return array
     */
    public function getValue()
    {
        return $this->value;
    }
    
    /**
     * @param StringValueObject $key
     *
     * @return IntegerValueObject
     */
    public function getIntegerValueObject(StringValueObject $key)
    {
        return new IntegerValueObject((int)$this->value[$key->getValue()]);
    }
    
    /**
     * @param StringValueObject $key
     *
     * @return StringValueObject
     */
    public function getStringValueObject(StringValueObject $key)
    {
        return new StringValueObject((String)$this->value[$key->getValue()]);
    }
    
    /**
     * @param StringValueObject $key
     *
     * @return ArrayValueObject
     */
    public function getArrayValueObject(StringValueObject $key)
    {
        return new ArrayValueObject($this->value[$key->getValue()]);
    }
    
    /**
     * @param IntegerValueObject $index
     *
     * @return bool
     */
    public function issetIndex(IntegerValueObject $index)
    {
        return isset($this->value[$index->getValue()]);
    }
    
    /**
     * @param StringValueObject $index
     *
     * @return bool
     */
    public function issetKey(StringValueObject $index)
    {
        return isset($this->value[$index->getValue()]);
    }
    
    /**
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->value);
    }
    
    /**
     * @return IntegerValueObject
     */
    public function count()
    {
        return new IntegerValueObject(count($this->value));
    }
}
