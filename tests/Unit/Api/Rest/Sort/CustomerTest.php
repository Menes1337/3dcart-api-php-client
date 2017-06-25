<?php

namespace tests\Unit\Api\Rest\Sort;

use tests\Unit\ThreeDCartTestCase;
use ThreeDCart\Api\Rest\Sort\Customer;
use ThreeDCart\Api\Rest\Sort\SortOrder;
use ThreeDCart\Primitive\StringValueObject;

/**
 * @package tests\Unit\Api\Rest\Sort
 */
class CustomerTest extends ThreeDCartTestCase
{
    /** @var Customer */
    private $subjectUnderTest;
    
    /** @var SortOrder */
    private $sortOrder;
    
    public function setup()
    {
        $this->sortOrder        = new SortOrder(SortOrder::SORTING_DESC);
        $this->subjectUnderTest = new Customer(
            new \ThreeDCart\Api\Rest\Field\Customer(
                \ThreeDCart\Api\Rest\Field\Customer::BILLINGLASTNAME
            ),
            $this->sortOrder
        );
    }
    
    public function testGetter()
    {
        $this->assertEquals(new SortOrder(SortOrder::SORTING_DESC), $this->subjectUnderTest->getSortOrder());
        $this->assertEquals(
            new StringValueObject(\ThreeDCart\Api\Rest\Field\Customer::BILLINGLASTNAME),
            $this->subjectUnderTest->getOrderByField()
        );
    }
    
    public function testDefaultSortOrderParameter()
    {
        $subjectUnderTest = new Customer(
            new \ThreeDCart\Api\Rest\Field\Customer(
                \ThreeDCart\Api\Rest\Field\Customer::SHIPPINGCITY
            )
        );
        $this->assertEquals(new SortOrder(SortOrder::SORTING_ASC), $subjectUnderTest->getSortOrder());
        $this->assertEquals(
            new StringValueObject(\ThreeDCart\Api\Rest\Field\Customer::SHIPPINGCITY),
            $subjectUnderTest->getOrderByField()
        );
    }
}
