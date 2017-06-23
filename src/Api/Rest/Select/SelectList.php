<?php

namespace ThreeDCart\Api\Rest\Select;

use ThreeDCart\Primitive\AbstractList;
use ThreeDCart\Primitive\StringValueObject;

class SelectList extends AbstractList implements SelectInterface
{
    /** @var AbstractSelect[] */
    protected $list;
    
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * @param AbstractSelect $orderBy
     */
    public function addSelect(AbstractSelect $orderBy)
    {
        $this->addEntry($orderBy);
    }
    
    /**
     * @return StringValueObject
     */
    public function getSelectQueryString()
    {
        $sortQuery = [];
        foreach ($this->list as $select) {
            $sortQuery[] = $select->getField()->getStringValue();
        }
        
        return new StringValueObject(implode(',', $sortQuery));
    }
}
