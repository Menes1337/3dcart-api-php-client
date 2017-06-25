<?php

namespace tests\Unit\Api\Rest\Authentication;

use tests\Unit\ThreeDCartTestCase;
use ThreeDCart\Api\Rest\Authentication\HttpHeader;

class HttpHeaderTest extends ThreeDCartTestCase
{
    public function testGetter()
    {
        $subjectUnderTest = new HttpHeader([]);
        
        $this->assertEquals([], $subjectUnderTest->getValue());
    }
}
