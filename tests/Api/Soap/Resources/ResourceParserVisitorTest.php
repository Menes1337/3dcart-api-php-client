<?php

namespace tests\Api\Soap\Resources;

use tests\ThreeDCartTestCase;
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
use ThreeDCart\Api\Soap\Resources\ResourceParserVisitor;

class ResourceParserVisitorTest extends ThreeDCartTestCase
{
    
    public function testVisitorProduct()
    {
        $product               = new Product();
        $resourceParserVisitor = $this->instantiateResourceParserVisitor('Product', 'Product.json');
        $resourceParserVisitor->visitProduct($product);
        
        $this->assertEquals(true, is_array($product->getCategories()));
        $this->assertEquals(false, empty($product->getCategories()));
        foreach ($product->getCategories() as $category) {
            $this->assertInstanceOf(Category::class, $category);
        }
        
        $this->assertEquals(true, is_array($product->getRelatedProducts()));
        $this->assertEquals(false, empty($product->getRelatedProducts()));
        foreach ($product->getRelatedProducts() as $relatedProduct) {
            $this->assertInstanceOf(RelatedProduct::class, $relatedProduct);
        }
        
        $this->assertEquals(true, is_array($product->getOptions()));
        $this->assertEquals(false, empty($product->getOptions()));
        foreach ($product->getOptions() as $option) {
            $this->assertInstanceOf(Option::class, $option);
        }
        
        $this->assertInstanceOf(ExtraField::class, $product->getExtraFields());
        $this->assertInstanceOf(EProduct::class, $product->getEProduct());
        $this->assertInstanceOf(Reward::class, $product->getRewards());
        $this->assertInstanceOf(Images::class, $product->getImages());
        
        $this->assertEquals(true, is_array($product->getImages()->getImages()));
        $this->assertEquals(false, empty($product->getImages()->getImages()));
        foreach ($product->getImages()->getImages() as $image) {
            $this->assertInstanceOf(Image::class, $image);
        }
    }
    
    public function testVisitorProductCategory()
    {
        $category              = new Category();
        $resourceParserVisitor = $this->instantiateResourceParserVisitor('ProductCategory', 'Category.json');
        $resourceParserVisitor->visitProductCategory($category);
        
        $this->assertEquals('4', $category->getCategoryID());
        $this->assertEquals('Apparel', $category->getCategoryName());
    }
    
    public function testVisitorProductEProduct()
    {
        $eProduct              = new EProduct();
        $resourceParserVisitor = $this->instantiateResourceParserVisitor('ProductEProduct', 'EProduct.json');
        $resourceParserVisitor->visitProductEProduct($eProduct);
        
        $this->assertEquals(null, $eProduct->getEProductPassword());
        $this->assertEquals('0', $eProduct->getEProductRandom());
        $this->assertEquals('0', $eProduct->getEProductExpire());
        $this->assertEquals(null, $eProduct->getEProductPath());
        $this->assertEquals('0', $eProduct->isEProductSerial());
        $this->assertEquals(null, $eProduct->getEProductInstructions());
        $this->assertEquals('0', $eProduct->isEProductReuseSerial());
    }
    
    public function testVisitorProductExtraFields()
    {
        $extraField            = new ExtraField();
        $resourceParserVisitor = $this->instantiateResourceParserVisitor('ProductExtraField', 'ExtraField.json');
        $resourceParserVisitor->visitProductExtraField($extraField);
        
        $this->assertEquals('123456789', $extraField->getExtraField1());
        $this->assertEquals('more custom 2', $extraField->getExtraField2());
        $this->assertEquals('and one more 3', $extraField->getExtraField3());
        $this->assertEquals(null, $extraField->getExtraField4());
        $this->assertEquals(null, $extraField->getExtraField5());
        $this->assertEquals('Extra Field 6    ', $extraField->getExtraField6());
        $this->assertEquals('xtr4 f13ld 7    ', $extraField->getExtraField7());
        $this->assertEquals(null, $extraField->getExtraField8());
        $this->assertEquals(null, $extraField->getExtraField9());
        $this->assertEquals(null, $extraField->getExtraField10());
        $this->assertEquals(null, $extraField->getExtraField11());
        $this->assertEquals(null, $extraField->getExtraField12());
        $this->assertEquals('extreFIeld13', $extraField->getExtraField13());
    }
    
    public function testVisitorProductImage()
    {
        $image                 = new Image();
        $resourceParserVisitor = $this->instantiateResourceParserVisitor('ProductImage', 'Image.json');
        $resourceParserVisitor->visitProductImage($image);
        
        $this->assertEquals(null, $image->getCaption());
        $this->assertEquals('assets/images/default/cap.jpg', $image->getUrl());
    }
    
    public function testVisitorProductImages()
    {
        $images                = new Images();
        $resourceParserVisitor = $this->instantiateResourceParserVisitor('ProductImages', 'Images.json');
        $resourceParserVisitor->visitProductImages($images);
        
        $this->assertEquals(true, is_array($images->getImages()));
        $this->assertEquals(false, empty($images->getImages()));
        foreach ($images->getImages() as $image) {
            $this->assertInstanceOf(Image::class, $image);
        }
        
        $this->assertEquals('assets/images/default/cap_thumbnail.jpg', $images->getThumbnail());
    }
    
    public function testVisitorProductOption()
    {
        $option                = new Option();
        $resourceParserVisitor = $this->instantiateResourceParserVisitor('ProductOption', 'Option.json');
        $resourceParserVisitor->visitProductOption($option);
        
        $this->assertEquals("2", $option->getId());
        $this->assertEquals("Color", $option->getOptionType());
        
        $this->assertEquals(true, is_array($option->getValues()));
        $this->assertEquals(false, empty($option->getValues()));
        foreach ($option->getValues() as $value) {
            $this->assertInstanceOf(OptionValue::class, $value);
        }
    }
    
    public function testVisitorProductOptionValue()
    {
        $optionValue           = new OptionValue();
        $resourceParserVisitor = $this->instantiateResourceParserVisitor('ProductOptionValue', 'OptionValue.json');
        $resourceParserVisitor->visitProductOptionValue($optionValue);
        
        $this->assertEquals("4", $optionValue->getID());
        $this->assertEquals("Red", $optionValue->getName());
        $this->assertEquals(null, $optionValue->getOptionPartNumber());
        $this->assertEquals("10.00", $optionValue->getOptionPrice());
    }
    
    public function testVisitorProductPriceLevel()
    {
        $priceLevel            = new PriceLevel();
        $resourceParserVisitor = $this->instantiateResourceParserVisitor('ProductPriceLevel', 'PriceLevel.json');
        $resourceParserVisitor->visitProductPriceLevel($priceLevel);
        
        $this->assertEquals("17.99", $priceLevel->getPrice_1());
        $this->assertEquals("16.99", $priceLevel->getPrice_2());
        $this->assertEquals("0", $priceLevel->getPrice_3());
        $this->assertEquals("0", $priceLevel->getPrice_4());
        $this->assertEquals("0", $priceLevel->getPrice_5());
        $this->assertEquals("0", $priceLevel->getPrice_6());
        $this->assertEquals("0", $priceLevel->getPrice_7());
        $this->assertEquals("0", $priceLevel->getPrice_8());
        $this->assertEquals("0", $priceLevel->getPrice_9());
        $this->assertEquals("14.99", $priceLevel->getPrice_10());
    }
    
    public function testVisitorProductRelatedProduct()
    {
        $relatedProduct        = new RelatedProduct();
        $resourceParserVisitor =
            $this->instantiateResourceParserVisitor('ProductRelatedProduct', 'RelatedProduct.json');
        $resourceParserVisitor->visitProductRelatedProduct($relatedProduct);
        
        $this->assertEquals("1002", $relatedProduct->getProductID());
        $this->assertEquals("Custom Cap 2", $relatedProduct->getProductName());
    }
    
    public function testVisitorProductReward()
    {
        $reward                = new Reward();
        $resourceParserVisitor = $this->instantiateResourceParserVisitor('ProductReward', 'Reward.json');
        $resourceParserVisitor->visitProductReward($reward);
        
        $this->assertEquals('123', $reward->getRewardPoints());
        $this->assertEquals('321', $reward->getRewardRedeem());
        $this->assertEquals('0', $reward->isRewardDisable());
    }
    
    /**
     * @param string $mock
     * @param string $mockPart
     *
     * @return ResourceParserVisitor
     */
    private function instantiateResourceParserVisitor($mock, $mockPart)
    {
        return new ResourceParserVisitor(json_decode($this->loadMock($mock, $mockPart), true));
    }
}
