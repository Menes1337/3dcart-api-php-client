<?php

namespace tests\Api\Soap\Resources;

use tests\ThreeDCartTestCase;
use ThreeDCart\Api\Soap\Exceptions\ParseException;
use ThreeDCart\Api\Soap\Resources\Product\Category;
use ThreeDCart\Api\Soap\Resources\Product\EProduct;
use ThreeDCart\Api\Soap\Resources\Product\ExtraField;
use ThreeDCart\Api\Soap\Resources\Product\Image;
use ThreeDCart\Api\Soap\Resources\Product\Images;
use ThreeDCart\Api\Soap\Resources\Product\Option;
use ThreeDCart\Api\Soap\Resources\Product\OptionValue;
use ThreeDCart\Api\Soap\Resources\Product\PriceLevel;
use ThreeDCart\Api\Soap\Resources\Product\Product;
use ThreeDCart\Api\Soap\Resources\Product\RelatedProduct;
use ThreeDCart\Api\Soap\Resources\Product\Reward;
use ThreeDCart\Api\Soap\Resources\ResourceParser;
use ThreeDCart\Api\Soap\Resources\ResourceParserInterface;
use ThreeDCart\Api\Soap\Resources\SoapResource;

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
        $this->resourceParser->getResource(Product::class, []);
    }
    
    public function testDataNull()
    {
        $this->expectException(ParseException::class);
        $this->resourceParser->getResource(Product::class, [null]);
    }
    
    public function testDataInvalid()
    {
        $this->expectException(ParseException::class);
        $this->resourceParser->getResource(Product::class, [
            'some_not_available_field' => 'not available value'
        ]);
    }
    
    /**
     * @param SoapResource $expectedClass
     * @param string       $mock
     * @param string       $mockPart
     *
     * @dataProvider getResourceFromArrayProvider
     */
    public function testCreateResource($expectedClass, $mock, $mockPart)
    {
        $data     = json_decode($this->loadMock($mock, $mockPart), true);
        $resource = $this->resourceParser->getResource($expectedClass, $data);
        
        $this->assertInstanceOf($expectedClass, $resource);
    }
    
    /**
     * @param SoapResource $expectedClass
     * @param string       $mock
     * @param string       $mockPart
     *
     * @dataProvider getResourceFromArrayProvider
     */
    public function testCreateResources($expectedClass, $mock, $mockPart)
    {
        $data = json_decode($this->loadMock($mock, $mockPart), true);
        
        $multipleData = array(
            $data,
            $data
        );
        
        $resources = $this->resourceParser->getResources($expectedClass, $multipleData);
        
        $this->assertEquals(2, count($resources));
        
        foreach ($resources as $resource) {
            $this->assertInstanceOf($expectedClass, $resource);
        }
    }
    
    public function getResourceFromArrayProvider()
    {
        return [
            'Product'                  => [
                Product::class,
                'Product',
                'Product.json'
            ],
            'Product - Category'       => [
                Category::class,
                'ProductCategory',
                'Category.json'
            ],
            'Product - EProduct'       => [
                EProduct::class,
                'ProductEProduct',
                'EProduct.json'
            ],
            'Product - ExtraField'     => [
                ExtraField::class,
                'ProductExtraField',
                'ExtraField.json'
            ],
            'Product - Image'          => [
                Image::class,
                'ProductImage',
                'Image.json'
            ],
            'Product - Images'         => [
                Images::class,
                'ProductImages',
                'Images.json'
            ],
            'Product - OptionValue'    => [
                OptionValue::class,
                'ProductOptionValue',
                'OptionValue.json'
            ],
            'Product - Option'         => [
                Option::class,
                'ProductOption',
                'Option.json'
            ],
            'Product - PriceLevel'     => [
                PriceLevel::class,
                'ProductPriceLevel',
                'PriceLevel.json'
            ],
            'Product - RelatedProduct' => [
                RelatedProduct::class,
                'ProductRelatedProduct',
                'RelatedProduct.json'
            ],
            'Product - Reward'         => [
                Reward::class,
                'ProductReward',
                'Reward.json'
            ],
        ];
    }
}
