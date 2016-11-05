<?php

namespace ThreeDCart\Api\Soap\Resources;

use ThreeDCart\Api\Soap\Resources\Customer\AdditionalFields;
use ThreeDCart\Api\Soap\Resources\Customer\Customer;
use ThreeDCart\Api\Soap\Resources\Customer\Address;
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
use ThreeDCart\Api\Soap\Resources\Product\ProductInventory;
use ThreeDCart\Api\Soap\Resources\Product\RelatedProduct;
use ThreeDCart\Api\Soap\Resources\Product\Reward;

interface VisitorInterface
{
    public function visitCustomer(Customer $customer);
    
    public function visitCustomerAddress(Address $address);
    
    public function visitCustomerAdditionalFields(AdditionalFields $additionalFields);
    
    public function visitProduct(Product $product);
    
    public function visitProductCategory(Category $category);
    
    public function visitProductEProduct(EProduct $eProduct);
    
    public function visitProductExtraFields(ExtraFields $extraFields);
    
    public function visitProductImages(Images $images);
    
    public function visitProductImage(Image $image);
    
    public function visitProductOption(Option $option);
    
    public function visitProductOptionValue(OptionValue $optionValue);
    
    public function visitProductPriceLevel(PriceLevel $priceLevel);
    
    public function visitProductRelatedProduct(RelatedProduct $relatedProduct);
    
    public function visitProductReward(Reward $reward);
    
    public function visitProductInventory(ProductInventory $productInventory);
    
    public function visitOrderStatus(OrderStatus $orderStatus);
}
