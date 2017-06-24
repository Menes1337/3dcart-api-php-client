<?php

namespace ThreeDCart\Api\Rest\Sort;

use ThreeDCart\Primitive\AbstractList;
use ThreeDCart\Primitive\StringValueObject;

class SortList extends AbstractList implements SortInterface
{
    /** @var AbstractOrderBy[] */
    protected $list;
    
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * @param AbstractOrderBy $orderBy
     */
    public function addOrderBy(AbstractOrderBy $orderBy)
    {
        $this->addEntry($orderBy);
    }
    
    /**
     * @return StringValueObject
     */
    public function getQueryString()
    {
        $sortQuery = [];
        foreach ($this->list as $orderBy) {
            $sortQuery[] = $orderBy->getOrderByField()->getStringValue() . ' ' . $orderBy->getSortOrder()->getValue();
        }
        
        return new StringValueObject(implode(',', $sortQuery));
    }
}
