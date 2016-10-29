<?php

namespace ThreeDCart\Api\Soap\Resources;

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

class ResourceParserVisitor implements VisitorInterface
{
    /** @var array */
    private $data;
    
    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }
    
    /**
     * @param SoapResource $resource
     * @param array        $data
     *
     * @throws ParseException
     */
    private function assignSimpleProperties(SoapResource $resource, array $data)
    {
        foreach ($data as $key => $value) {
            if (method_exists($resource, 'get' . $key) && call_user_func(array($resource, 'get' . $key))) {
                continue;
            }
            if (!method_exists($resource, 'set' . $key)) {
                throw new ParseException('unable to create resource. setter set' . $key . '() don\'t exist');
            }
            $resource->{'set' . $key}($value);
        }
    }
    
    /**
     * @param array       $data
     * @param string      $objectIndex
     * @param string|null $objectIndexChild
     *
     * @return array|mixed
     */
    private function reduceData(array $data, $objectIndex, $objectIndexChild = null)
    {
        if (!isset($data[$objectIndex])
            || !is_array($data[$objectIndex])
        ) {
            return array();
        }
        $data = $data[$objectIndex];
        
        if ($objectIndexChild !== null) {
            if (!isset($data[$objectIndexChild])
                || !is_array($data[$objectIndexChild])
            ) {
                return array();
            }
            $data = $data[$objectIndexChild];
        }
        
        return $data;
    }
    
    /**
     * Will create an array of objects of type $className from an passed array of objectData by using
     *
     * @param string      $className
     * @param array       $data
     * @param string      $objectIndex
     * @param string|null $objectIndexChild
     *
     * @return SoapResource[]
     */
    private function createObjects($className, array $data, $objectIndex, $objectIndexChild = null)
    {
        if (!$data = $this->reduceData($data, $objectIndex, $objectIndexChild)) {
            return $data;
        }
        
        if (!isset($data[0]) && !empty($data)) {
            // We need a special logic in case the API returns jut one element instead of an array
            return array($this->createObject($className, $data));
        }
        
        $objects = array();
        foreach ($data as $objectData) {
            if ($object = $this->createObject($className, $objectData)) {
                $objects[] = $object;
            }
        }
        
        return $objects;
    }
    
    /**
     * @param string $className
     * @param array  $objectData
     * @param string $objectIndex
     *
     * @return SoapResource
     */
    private function createObject($className, array $objectData, $objectIndex = null)
    {
        /** @var SoapResource $resource */
        $resource = new $className();
        
        if ($objectIndex !== null) {
            if (!isset($objectData[$objectIndex])) {
                return $resource;
            }
            $objectData = $objectData[$objectIndex];
        }
        
        $visitor = new ResourceParserVisitor($objectData);
        $resource->accept($visitor);
        
        return $resource;
    }
    
    /**
     * @param Product $product
     */
    public function visitProduct(Product $product)
    {
        $product->setCategories($this->createObjects(Category::class, $this->data, 'Categories', 'Category'));
        $product->setRelatedProducts($this->createObjects(RelatedProduct::class, $this->data, 'RelatedProducts',
            'Product'));
        $product->setOptions($this->createObjects(Option::class, $this->data, 'Options', 'Option'));
        
        $product->setExtraFields($this->createObject(ExtraField::class, $this->data, 'ExtraFields'));
        $product->setPriceLevel($this->createObject(PriceLevel::class, $this->data, 'PriceLevel'));
        $product->setEProduct($this->createObject(EProduct::class, $this->data, 'eProduct'));
        $product->setRewards($this->createObject(Reward::class, $this->data, 'Rewards'));
        $product->setImages($this->createObject(Images::class, $this->data, 'Images'));
        
        $this->assignSimpleProperties($product, $this->data);
    }
    
    /**
     * @param Category $category
     */
    public function visitProductCategory(Category $category)
    {
        $this->assignSimpleProperties($category, $this->data);
    }
    
    public function visitProductEProduct(EProduct $eProduct)
    {
        $this->assignSimpleProperties($eProduct, $this->data);
    }
    
    public function visitProductExtraField(ExtraField $extraField)
    {
        $this->assignSimpleProperties($extraField, $this->data);
    }
    
    public function visitProductImages(Images $images)
    {
        $images->setImages($this->createObjects(Image::class, $this->data, 'Image'));
        if (isset($this->data['Image'])) {
            unset($this->data['Image']);
        }
        $this->assignSimpleProperties($images, $this->data);
    }
    
    public function visitProductImage(Image $image)
    {
        $this->assignSimpleProperties($image, $this->data);
    }
    
    public function visitProductOption(Option $option)
    {
        $option->setValues($this->createObjects(OptionValue::class, $this->data, 'Values', 'Value'));
        
        $this->assignSimpleProperties($option, $this->data);
    }
    
    public function visitProductOptionValue(OptionValue $optionValue)
    {
        $this->assignSimpleProperties($optionValue, $this->data);
    }
    
    public function visitProductPriceLevel(PriceLevel $priceLevel)
    {
        $this->assignSimpleProperties($priceLevel, $this->data);
    }
    
    public function visitProductRelatedProduct(RelatedProduct $relatedProduct)
    {
        $this->assignSimpleProperties($relatedProduct, $this->data);
    }
    
    public function visitProductReward(Reward $reward)
    {
        $this->assignSimpleProperties($reward, $this->data);
    }
}
