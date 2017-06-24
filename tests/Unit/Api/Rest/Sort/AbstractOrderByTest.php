<?php

namespace tests\Unit\Api\Rest\Sort;

use tests\Unit\ThreeDCartTestCase;
use ThreeDCart\Api\Rest\Sort\AbstractOrderBy;
use ThreeDCart\Api\Rest\Sort\SortOrder;
use ThreeDCart\Primitive\StringValueObject;

/**
 * @package tests\Unit\Api\Rest\Sort
 */
class AbstractOrderByTest extends ThreeDCartTestCase
{
    /** @var AbstractOrderBy */
    private $subjectUnderTest;
    
    public function setup()
    {
        $this->subjectUnderTest = $this->getMockBuilder(AbstractOrderBy::class)
                                       ->setConstructorArgs([
                                               new StringValueObject('test'),
                                               new SortOrder(SortOrder::SORTING_ASC)
                                           ]
                                       )
                                       ->setMethods([])
                                       ->getMockForAbstractClass();
    }
    
    public function testGetter()
    {
        $this->assertEquals(new StringValueObject('test'), $this->subjectUnderTest->getOrderByField());
        $this->assertEquals(new SortOrder(SortOrder::SORTING_ASC), $this->subjectUnderTest->getSortOrder());
    }
}
