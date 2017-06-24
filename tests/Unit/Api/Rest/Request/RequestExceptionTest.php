<?php

namespace tests\Unit\Api\Rest\Request;

use tests\Unit\ThreeDCartTestCase;
use ThreeDCart\Api\Rest\Request\RequestException;
use ThreeDCart\Primitive\IntegerValueObject;
use ThreeDCart\Primitive\StringValueObject;

/**
 * Class HttpPostTest
 *
 * @package tests\Unit\Api\Rest\Request
 */
class HttpParameterTest extends ThreeDCartTestCase
{
    /** @var RequestException */
    private $subjectUnderTest;
    
    public function setup()
    {
        $this->subjectUnderTest = new RequestException(
            new StringValueObject('test message'),
            new IntegerValueObject(321),
            new IntegerValueObject(123),
            new StringValueObject('response body')
        );
    }
    
    public function testGetter()
    {
        $this->assertEquals('test message', $this->subjectUnderTest->getMessage());
        $this->assertEquals(321, $this->subjectUnderTest->getCode());
        $this->assertEquals(new StringValueObject('response body'), $this->subjectUnderTest->getResponseBody());
        $this->assertEquals(new IntegerValueObject(123), $this->subjectUnderTest->getHttpStatusCode());
    }
}
