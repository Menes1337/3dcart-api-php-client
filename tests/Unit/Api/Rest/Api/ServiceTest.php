<?php

namespace tests\Unit\Api\Rest\Api;

use tests\Unit\ThreeDCartTestCase;
use ThreeDCart\Api\Rest\Api\Service;

class ServiceTest extends ThreeDCartTestCase
{
    public function testGetter()
    {
        $subjectUnderTest = new Service(Service::PRODUCTS);
        
        $this->assertEquals('Products', $subjectUnderTest->getStringValue());
    }
}
