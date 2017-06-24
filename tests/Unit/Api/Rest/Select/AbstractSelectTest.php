<?php

namespace tests\Unit\Api\Rest\Request;

use tests\Unit\ThreeDCartTestCase;
use ThreeDCart\Api\Rest\Request\HttpParameter;
use ThreeDCart\Api\Rest\Select\AbstractSelect;
use ThreeDCart\Primitive\StringValueObject;

/**
 * Class AbstractSelectTest
 *
 * @package tests\Unit\Api\Rest\Select
 */
class AbstractSelectTest extends ThreeDCartTestCase
{
    /** @var AbstractSelect */
    private $subjectUnderTest;
    
    public function setup()
    {
        $this->subjectUnderTest = $this->getMockBuilder(AbstractSelect::class)
                                       ->setConstructorArgs([new StringValueObject('test')])
                                       ->setMethods([])
                                       ->getMockForAbstractClass();
    }
    
    public function testGetter()
    {
        $this->assertEquals(new StringValueObject('test'), $this->subjectUnderTest->getField());
    }
}
