<?php

namespace tests\Unit\Api\Rest\Request;

use tests\Unit\ThreeDCartTestCase;
use ThreeDCart\Api\Rest\Select\Customer;
use ThreeDCart\Primitive\StringValueObject;

/**
 * Class CustomerTest
 *
 * @package tests\Unit\Api\Rest\Select
 */
class CustomerTest extends ThreeDCartTestCase
{
    /** @var Customer */
    private $subjectUnderTest;
    
    public function setup()
    {
        $this->subjectUnderTest = new Customer(
            new \ThreeDCart\Api\Rest\Field\Customer(\ThreeDCart\Api\Rest\Field\Customer::BILLINGCITY)
        );
    }
    
    public function testGetter()
    {
        $this->assertEquals(
            new StringValueObject(\ThreeDCart\Api\Rest\Field\Customer::BILLINGCITY),
            $this->subjectUnderTest->getField()
        );
    }
}
