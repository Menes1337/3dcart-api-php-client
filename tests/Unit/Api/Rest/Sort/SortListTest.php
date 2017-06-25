<?php

namespace tests\Unit\Api\Rest\Sort;

use tests\Unit\ThreeDCartTestCase;
use ThreeDCart\Api\Rest\Sort\AbstractOrderBy;
use ThreeDCart\Api\Rest\Sort\SortOrder;
use ThreeDCart\Api\Rest\Sort\SortList;
use ThreeDCart\Primitive\StringValueObject;

/**
 * @package tests\Unit\Api\Rest\Sort
 */
class SortListTest extends ThreeDCartTestCase
{
    /** @var SortList */
    private $subjectUnderTest;
    
    public function setup()
    {
        $this->subjectUnderTest = new SortList();
    }
    
    public function testGenerationOfQueryStringOneEntry()
    {
        /** @var AbstractOrderBy $sortOrderBy */
        $sortOrderBy = $this->getMockBuilder(AbstractOrderBy::class)
                            ->setConstructorArgs([
                                new StringValueObject('test'),
                                new SortOrder(SortOrder::SORTING_ASC)
                            ])
                            ->getMockForAbstractClass();
        
        $this->subjectUnderTest->addOrderBy($sortOrderBy);
        
        $this->assertEquals(new StringValueObject('test asc'), $this->subjectUnderTest->getQueryString());
    }
    
    public function testGenerationOfQueryStringTwoEntries()
    {
        /** @var AbstractOrderBy $sortOrderBy */
        $sortOrderBy = $this->getMockBuilder(AbstractOrderBy::class)
                            ->setConstructorArgs([
                                new StringValueObject('first_order_by'),
                                new SortOrder(SortOrder::SORTING_ASC)
                            ])
                            ->getMockForAbstractClass();
        
        $this->subjectUnderTest->addOrderBy($sortOrderBy);
        
        /** @var AbstractOrderBy $secondOrderBy */
        $secondOrderBy = $this->getMockBuilder(AbstractOrderBy::class)
                              ->setConstructorArgs([
                                  new StringValueObject('second_order_by'),
                                  new SortOrder(SortOrder::SORTING_DESC)
                              ])
                              ->getMockForAbstractClass();
        
        $this->subjectUnderTest->addOrderBy($secondOrderBy);
        
        $this->assertEquals(new StringValueObject('first_order_by asc,second_order_by desc'),
            $this->subjectUnderTest->getQueryString());
    }
}
