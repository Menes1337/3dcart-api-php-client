<?php

namespace tests\Api\Soap\Resources;

use tests\ThreeDCartTestCase;
use ThreeDCart\Api\Soap\Exceptions\ParseException;
use ThreeDCart\Api\Soap\Resources\Product\Product;
use ThreeDCart\Api\Soap\Resources\ResourceParser;
use ThreeDCart\Api\Soap\Resources\ResourceParserInterface;

class ResourceParserTest extends ThreeDCartTestCase
{
    /** @var ResourceParserInterface */
    private $resourceParser;
    
    public function setup()
    {
        $this->resourceParser = new ResourceParser();
    }
    
    public function testInitialization()
    {
        $this->assertInstanceOf(ResourceParserInterface::class, $this->resourceParser);
    }
    
    public function testDataEmpty()
    {
        $this->expectException(ParseException::class);
        $this->resourceParser->getResourceFromArray(Product::class, []);
    }
    
    public function testDataNull()
    {
        $this->expectException(ParseException::class);
        $this->resourceParser->getResourceFromArray(Product::class, [null]);
    }
    
    public function testDataInvalid()
    {
        $this->expectException(ParseException::class);
        $this->resourceParser->getResourceFromArray(Product::class, [
            'some_not_available_field' => 'not available value'
        ]);
    }
}
