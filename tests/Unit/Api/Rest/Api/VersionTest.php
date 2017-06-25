<?php

namespace tests\Unit\Api\Rest\Api;

use tests\Unit\ThreeDCartTestCase;
use ThreeDCart\Api\Rest\Api\Version;

class VersionTest extends ThreeDCartTestCase
{
    public function testGetter()
    {
        $subjectUnderTest = new Version(Version::VERSION_1);
        
        $this->assertEquals('v1', $subjectUnderTest->getStringValue());
    }
}
