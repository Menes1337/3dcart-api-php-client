<?php

namespace tests\Api\Soap\Resources;

use tests\ThreeDCartTestCase;
use ThreeDCart\Api\Soap\Resources\Customer\AdditionalFields;
use ThreeDCart\Api\Soap\Resources\Customer\Address;
use ThreeDCart\Api\Soap\Resources\Customer\Customer;
use ThreeDCart\Api\Soap\Resources\Order\OrderStatus;
use ThreeDCart\Api\Soap\Resources\Product\Category;
use ThreeDCart\Api\Soap\Resources\Product\EProduct;
use ThreeDCart\Api\Soap\Resources\Product\ExtraFields;
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
    
    public function testVisitorCustomer()
    {
        $customer              = new Customer();
        $resourceParserVisitor = $this->instantiateResourceParserVisitor('Customer', 'Customer.json');
        $resourceParserVisitor->visitCustomer($customer);
        
        $this->assertInstanceOf(Address::class, $customer->getBillingAddress());
        $this->assertInstanceOf(Address::class, $customer->getShippingAddress());
        $this->assertInstanceOf(AdditionalFields::class, $customer->getAditionalFields());
        
        $this->assertEquals('1', $customer->getCustomerID());
        $this->assertEquals('Administrator', $customer->getUserID());
        $this->assertEquals('Sample Customer from 3dcart', $customer->getComments());
        $this->assertEquals('5/6/2014', $customer->getLastLoginDate());
        $this->assertEquals(null, $customer->getWebSite());
        $this->assertEquals(null, $customer->getDiscountGroup());
        $this->assertEquals(null, $customer->getAccountNumber());
        $this->assertEquals('1', $customer->isMailList());
        $this->assertEquals('0', $customer->isCustomerType());
        $this->assertEquals('6/22/2009', $customer->getLastUpdate());
        $this->assertEquals('1', $customer->isCustEnabled());
        $this->assertEquals(null, $customer->getAdditionalField4());
    }
    
    public function testVisitorAddress()
    {
        $address               = new Address();
        $resourceParserVisitor = $this->instantiateResourceParserVisitor('CustomerAddress', 'Address.json');
        $resourceParserVisitor->visitCustomerAddress($address);
        
        $this->assertEquals('John', $address->getFirstName());
        $this->assertEquals('Doe', $address->getLastName());
        $this->assertEquals('123 Street', $address->getAddress());
        $this->assertEquals(null, $address->getAddress2());
        $this->assertEquals('Coral Springs', $address->getCity());
        $this->assertEquals('FL', $address->getStateCode());
        $this->assertEquals('33065', $address->getZipCode());
        $this->assertEquals('US', $address->getCountryCode());
        $this->assertEquals('3DCart', $address->getCompany());
        $this->assertEquals('800-828-6650', $address->getPhone());
        $this->assertEquals('test@3dcart.com', $address->getEmail());
    }
    
    public function testVisitorAdditionalFields()
    {
        $additionalFields      = new AdditionalFields();
        $resourceParserVisitor =
            $this->instantiateResourceParserVisitor('CustomerAdditionalFields', 'AdditionalFields.json');
        $resourceParserVisitor->visitCustomerAdditionalFields($additionalFields);
        
        $this->assertEquals('some information', $additionalFields->getAdditionalField1());
        $this->assertEquals('another information', $additionalFields->getAdditionalField2());
        $this->assertEquals(null, $additionalFields->getAdditionalField3());
    }
    
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
        
        $this->assertInstanceOf(ExtraFields::class, $product->getExtraFields());
        $this->assertInstanceOf(EProduct::class, $product->getEProduct());
        $this->assertInstanceOf(Reward::class, $product->getRewards());
        $this->assertInstanceOf(Images::class, $product->getImages());
        
        $this->assertEquals(true, is_array($product->getImages()->getImages()));
        $this->assertEquals(false, empty($product->getImages()->getImages()));
        foreach ($product->getImages()->getImages() as $image) {
            $this->assertInstanceOf(Image::class, $image);
        }
        
        $this->assertEquals('1', $product->getCatalogID());
        $this->assertEquals('Custom Cap', $product->getProductID());
        $this->assertEquals('Custom Cap', $product->getProductName());
        $this->assertEquals('MPNNUMBER', $product->getMfgid());
        $this->assertEquals('MyManufacturer', $product->getManufacturer());
        $this->assertEquals('Test', $product->getDistributor());
        $this->assertEquals('0.00', $product->getCost());
        $this->assertEquals('17.99', $product->getPrice());
        $this->assertEquals('0', $product->getRetailPrice());
        $this->assertEquals('19.99', $product->getSalePrice());
        $this->assertEquals('1', $product->isOnSale());
        $this->assertEquals('0', $product->getStock());
        $this->assertEquals('0', $product->getStockAlert());
        $this->assertEquals('2.00', $product->getWeight());
        $this->assertEquals('44.00', $product->getWidth());
        $this->assertEquals('33.00', $product->getHeight());
        $this->assertEquals('55.00', $product->getDepth());
        $this->assertEquals('1', $product->getMinimumOrder());
        $this->assertEquals('0', $product->getMaximumOrder());
        $this->assertEquals('6/22/2009', $product->getDateCreated());
        $this->assertEquals('Sample Product', $product->getDescription());
        $this->assertEquals('<div><strong><span style="COLOR: #ff0000">SAMPLE PRODUCT </span></strong></div><div>&nbsp;</div><div>Our adjustable, 100% brushed cotton Cap is unstructured and an ideal way to beat the heat.</div>    ',
            $product->getExtendedDescription());
        $this->assertEquals('My;Key;words', $product->getKeywords());
        $this->assertEquals('0.00', $product->getShipCost());
        $this->assertEquals('Title Of MetaTags', $product->getTitle());
        $this->assertEquals('<META NAME="DESCRIPTION" CONTENT="gffghnhg"><META NAME="ABSTRACT" CONTENT="mbjmhj"><META NAME="KEYWORDS" CONTENT="bmvghjhjm">',
            $product->getMetaTags());
        $this->assertEquals('DIsplayTesxt', $product->getDisplayText());
        $this->assertEquals('1', $product->isHomeSpecial());
        $this->assertEquals('0', $product->isCategorySpecial());
        $this->assertEquals('0', $product->isHide());
        $this->assertEquals('1', $product->isFreeShipping());
        $this->assertEquals('0', $product->isNonTax());
        $this->assertEquals('0', $product->isNotForsale());
        $this->assertEquals('0', $product->isGiftCertificate());
        $this->assertEquals('Administrator', $product->getUserId());
        $this->assertEquals('10/16/2016 9:50:30 AM', $product->getLastUpdate());
        $this->assertEquals(null, $product->getWarehouseLocation());
        $this->assertEquals(null, $product->getWarehouseBin());
        $this->assertEquals(null, $product->getWarehouseAisle());
        $this->assertEquals(null, $product->getWarehouseCustom());
        $this->assertEquals('0', $product->isUseCatoptions());
        $this->assertEquals(null, $product->getQuantityOptions());
        $this->assertEquals('0', $product->getMinOrder());
        $this->assertEquals('-1', $product->getListingDisplayType());
        $this->assertEquals('-1', $product->getShowOutStock());
        $this->assertEquals('0', $product->getPricingGroupOpt());
        $this->assertEquals('0', $product->getQuantityDiscountOpt());
        $this->assertEquals('-1', $product->getLoginLevel());
        $this->assertEquals(null, $product->getRedirectTo());
        $this->assertEquals(null, $product->getAccessGroup());
        $this->assertEquals('1', $product->isSelfShip());
        $this->assertEquals('MyT', $product->getTaxCode());
        $this->assertEquals('0', $product->isNonSearchable());
        $this->assertEquals('InStock message', $product->getInstockMessage());
        $this->assertEquals('Out Stock Message', $product->getOutOfStockMessage());
        $this->assertEquals('Back order Message', $product->getBackOrderMessage());
        $this->assertEquals('MyCustomFileName', $product->getFileName());
        $this->assertEquals('3', $product->getReviewAverage());
        $this->assertEquals('1', $product->getReviewCount());
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
        $extraFields           = new ExtraFields();
        $resourceParserVisitor = $this->instantiateResourceParserVisitor('ProductExtraField', 'ExtraField.json');
        $resourceParserVisitor->visitProductExtraFields($extraFields);
        
        $this->assertEquals('123456789', $extraFields->getExtraField1());
        $this->assertEquals('more custom 2', $extraFields->getExtraField2());
        $this->assertEquals('and one more 3', $extraFields->getExtraField3());
        $this->assertEquals(null, $extraFields->getExtraField4());
        $this->assertEquals(null, $extraFields->getExtraField5());
        $this->assertEquals('Extra Field 6    ', $extraFields->getExtraField6());
        $this->assertEquals('xtr4 f13ld 7    ', $extraFields->getExtraField7());
        $this->assertEquals(null, $extraFields->getExtraField8());
        $this->assertEquals(null, $extraFields->getExtraField9());
        $this->assertEquals(null, $extraFields->getExtraField10());
        $this->assertEquals(null, $extraFields->getExtraField11());
        $this->assertEquals(null, $extraFields->getExtraField12());
        $this->assertEquals('extreFIeld13', $extraFields->getExtraField13());
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
    
    public function testVisitorOrderStatus()
    {
        $orderStatus           = new OrderStatus();
        $resourceParserVisitor = $this->instantiateResourceParserVisitor('OrderStatus', 'OrderStatus.json');
        $resourceParserVisitor->visitOrderStatus($orderStatus);
        
        $this->assertEquals('1', $orderStatus->getId());
        $this->assertEquals('AB-1347', $orderStatus->getInvoiceNum());
        $this->assertEquals('New', $orderStatus->getStatusText());
    }
    
    public function testVisitorProductOptionInvalidData()
    {
        $option                = new Option();
        $resourceParserVisitor = new ResourceParserVisitor(['Values' => ['Wrong index' => []]]);
        $resourceParserVisitor->visitProductOption($option);
        
        $this->assertEquals(true, is_array($option->getValues()));
        $this->assertEquals(true, empty($option->getValues()));
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
