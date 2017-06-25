<?php

namespace tests\Unit\Api\Rest\Resource;

use tests\Unit\ThreeDCartTestCase;
use ThreeDCart\Api\Rest\Resource\AbstractResource;
use ThreeDCart\Api\Rest\Resource\Customer;

class AbstractResourceTest extends ThreeDCartTestCase
{
    /** @var AbstractResource */
    private $subjectUnderTest;
    
    public function setUp()
    {
        $this->subjectUnderTest = $this->getMockBuilder(AbstractResource::class)->getMockForAbstractClass();
    }
    
    /**
     * @param string $expectedResourceClass
     * @param string $jsonData
     *
     * @dataProvider provideResources
     */
    public function testCreateResource($expectedResourceClass, $jsonData)
    {
        /** @var AbstractResource $expectedResourceClass */
        $resourceClass = $expectedResourceClass::fromArray(json_decode($jsonData, true));
        
        $this->assertEquals($expectedResourceClass, get_class($resourceClass));
    }
    
    public function provideResources()
    {
        return [
            'customer resource' => [
                Customer::class,
                $this->loadMock('getCustomer', 'response.json')
            ]
        ];
    }
}
