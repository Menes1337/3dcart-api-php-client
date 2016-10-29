<?php

namespace ThreeDCart\Api\Soap\Resources;

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

interface VisitorInterface
{
    public function visitProduct(Product $product);
    
    public function visitProductCategory(Category $category);
    
    public function visitProductEProduct(EProduct $eProduct);
    
    public function visitProductExtraField(ExtraField $extraField);
    
    public function visitProductImages(Images $images);
    
    public function visitProductImage(Image $image);
    
    public function visitProductOption(Option $option);
    
    public function visitProductOptionValue(OptionValue $optionValue);
    
    public function visitProductPriceLevel(PriceLevel $priceLevel);
    
    public function visitProductRelatedProduct(RelatedProduct $relatedProduct);
    
    public function visitProductReward(Reward $reward);
}
