<?php

namespace ThreeDCart\Api\Rest\Select;

use ThreeDCart\Primitive\AbstractList;
use ThreeDCart\Primitive\StringValueObject;

class SelectList extends AbstractList implements SelectListInterface
{
    /** @var SelectInterface[] */
    protected $list;
    
    /**
     * @param SelectInterface $orderBy
     */
    public function addSelect(SelectInterface $orderBy)
    {
        $this->addEntry($orderBy);
    }
    
    /**
     * @return StringValueObject
     */
    public function getQueryString()
    {
        $sortQuery = [];
        foreach ($this->list as $select) {
            $sortQuery[] = $select->getField()->getStringValue();
        }
        
        return new StringValueObject(implode(',', $sortQuery));
    }
}
