<?php

namespace ThreeDCart\Api\Soap\Resources;

use ThreeDCart\Api\Soap\Exceptions\ParseException;
use ThreeDCart\Api\Soap\Resources\Customer\AdditionalFields;
use ThreeDCart\Api\Soap\Resources\Customer\Customer;
use ThreeDCart\Api\Soap\Resources\Customer\Address;
use ThreeDCart\Api\Soap\Resources\Customer\LoginToken;
use ThreeDCart\Api\Soap\Resources\Order\AffiliateInformation;
use ThreeDCart\Api\Soap\Resources\Order\CheckoutQuestion;
use ThreeDCart\Api\Soap\Resources\Order\Comments;
use ThreeDCart\Api\Soap\Resources\Order\GiftCertificatePurchased;
use ThreeDCart\Api\Soap\Resources\Order\GiftCertificateUsed;
use ThreeDCart\Api\Soap\Resources\Order\Item;
use ThreeDCart\Api\Soap\Resources\Order\Order;
use ThreeDCart\Api\Soap\Resources\Order\Promotion;
use ThreeDCart\Api\Soap\Resources\Order\Shipment;
use ThreeDCart\Api\Soap\Resources\Order\ShippingInformation;
use ThreeDCart\Api\Soap\Resources\Order\Status;
use ThreeDCart\Api\Soap\Resources\Order\Transaction;
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
            if (method_exists($resource, 'get' . $key) && call_user_func(array($resource, 'get' . $key)) !== null) {
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
     * @return array
     */
    private function reduceHierarchy(array $data, $objectIndex, $objectIndexChild = null)
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
        if (!$data = $this->reduceHierarchy($data, $objectIndex, $objectIndexChild)) {
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
        
        $product->setExtraFields($this->createObject(ExtraFields::class, $this->data, 'ExtraFields'));
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
    
    public function visitProductExtraFields(ExtraFields $extraFields)
    {
        $this->assignSimpleProperties($extraFields, $this->data);
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
    
    public function visitCustomer(Customer $customer)
    {
        $customer->setAditionalFields($this->createObject(AdditionalFields::class, $this->data, 'AditionalFields'));
        $customer->setBillingAddress($this->createObject(Address::class, $this->data, 'BillingAddress'));
        $customer->setShippingAddress($this->createObject(Address::class, $this->data, 'ShippingAddress'));
        
        $this->assignSimpleProperties($customer, $this->data);
    }
    
    public function visitCustomerAddress(Address $address)
    {
        $this->assignSimpleProperties($address, $this->data);
    }
    
    public function visitCustomerAdditionalFields(AdditionalFields $additionalFields)
    {
        $this->assignSimpleProperties($additionalFields, $this->data);
    }
    
    public function visitOrderStatus(Status $orderStatus)
    {
        $this->assignSimpleProperties($orderStatus, $this->data);
    }
    
    public function visitProductInventory(ProductInventory $productInventory)
    {
        $this->assignSimpleProperties($productInventory, $this->data);
    }
    
    public function visitCustomerLoginToken(LoginToken $loginToken)
    {
        $this->assignSimpleProperties($loginToken, $this->data);
    }
    
    public function visitOrder(Order $order)
    {
        $order->setPromotions($this->createObjects(Promotion::class, $this->data, 'Promotions', 'Promotion'));
        
        $order->setBillingAddress($this->createObject(Address::class, $this->data, 'BillingAddress'));
        $order->setComments($this->createObject(Comments::class, $this->data, 'Comments'));
        $order->setTransaction($this->createObject(Transaction::class, $this->data, 'Transaction'));
        $order->setCheckoutQuestions($this->createObjects(CheckoutQuestion::class, $this->data, 'CheckoutQuestions',
            'Question'));
        $order->setAffiliateInformation($this->createObject(AffiliateInformation::class, $this->data,
            'AffiliateInformation'));
        $order->setShippingInformation($this->createObject(ShippingInformation::class, $this->data,
            'ShippingInformation'));
        
        $giftCertificatePurchased = $this->createObjects(GiftCertificatePurchased::class, $this->data,
            'GiftCertificatePurchased', 'Gift');
        $order->setGiftCertificatePurchased(isset($giftCertificatePurchased[0]) ? $giftCertificatePurchased[0] : null);
        
        $giftCertificateUsed = $this->createObjects(GiftCertificateUsed::class, $this->data,
            'GiftCertificateUsed', 'Gift');
        $order->setGiftCertificateUsed(isset($giftCertificateUsed[0]) ? $giftCertificateUsed[0] : null);
        
        $this->assignSimpleProperties($order, $this->data);
    }
    
    public function visitOrderComments(Comments $comments)
    {
        $this->assignSimpleProperties($comments, $this->data);
    }
    
    public function visitOrderAffiliateInformation(AffiliateInformation $affiliateInformation)
    {
        $this->assignSimpleProperties($affiliateInformation, $this->data);
    }
    
    public function visitOrderGiftCertificatePurchased(GiftCertificatePurchased $giftCertificatePurchased)
    {
        $this->assignSimpleProperties($giftCertificatePurchased, $this->data);
    }
    
    public function visitOrderGiftCertificateUsed(GiftCertificateUsed $giftCertificateUsed)
    {
        $this->assignSimpleProperties($giftCertificateUsed, $this->data);
    }
    
    public function visitOrderItem(Item $item)
    {
        $this->assignSimpleProperties($item, $this->data);
    }
    
    public function visitOrderPromotion(Promotion $promotion)
    {
        $this->assignSimpleProperties($promotion, $this->data);
    }
    
    public function visitOrderShipment(Shipment $shipment)
    {
        $this->assignSimpleProperties($shipment, $this->data);
    }
    
    public function visitOrderShippingInformation(ShippingInformation $shippingInformation)
    {
        $shippingInformation->setShipment($this->createObject(Shipment::class, $this->data, 'Shipment'));
        $shippingInformation->setOrderItems($this->createObjects(Item::class, $this->data, 'OrderItems', 'Item'));
    }
    
    public function visitOrderTransaction(Transaction $transaction)
    {
        $this->assignSimpleProperties($transaction, $this->data);
    }
    
    public function visitOrderCheckoutQuestion(CheckoutQuestion $checkoutQuestion)
    {
        $this->assignSimpleProperties($checkoutQuestion, $this->data);
    }
}
