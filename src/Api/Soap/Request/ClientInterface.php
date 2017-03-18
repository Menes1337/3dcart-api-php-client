<?php

namespace ThreeDCart\Api\Soap\Request;

use ThreeDCart\Api\Soap\Parameter\BatchSize;
use ThreeDCart\Api\Soap\Parameter\CallBackUrl;
use ThreeDCart\Api\Soap\Parameter\CustomerAction;
use ThreeDCart\Api\Soap\Parameter\StartNum;
use ThreeDCart\Api\Soap\Response\Xml;
use ThreeDCart\Primitive\BooleanValueObject;
use ThreeDCart\Primitive\IntegerValueObject;
use ThreeDCart\Primitive\StringValueObject;

/**
 * Interface ClientInterface
 *
 * @package ThreeDCart\Api\Soap\Request
 */
interface ClientInterface
{
    /**
     * @param BatchSize         $batchSize
     * @param StartNum          $startNum
     * @param StringValueObject $productId
     * @param CallBackUrl       $callBackUrl
     *
     * @return Xml
     *
     * @throws ResponseBodyEmptyException
     */
    public function getProduct(
        BatchSize $batchSize,
        StartNum $startNum,
        StringValueObject $productId,
        CallBackUrl $callBackUrl
    );
    
    /**
     * @param BatchSize         $batchSize
     * @param StartNum          $startNum
     * @param StringValueObject $customersFilter
     * @param CallBackUrl       $callBackUrl
     *
     * @return Xml
     *
     * @throws ResponseBodyEmptyException
     */
    public function getCustomers(
        BatchSize $batchSize,
        StartNum $startNum,
        StringValueObject $customersFilter,
        CallBackUrl $callBackUrl
    );
    
    /**
     * @param StringValueObject $invoiceNum
     * @param CallBackUrl       $callBackUrl
     *
     * @return Xml
     *
     * @throws ResponseInvalidException
     */
    public function getOrderStatus(StringValueObject $invoiceNum, CallBackUrl $callBackUrl);
    
    /**
     * @param CallBackUrl $callBackUrl
     *
     * @return Xml
     *
     * @throws ResponseInvalidException
     */
    public function getProductCount(CallBackUrl $callBackUrl);
    
    /**
     * @param StringValueObject $productId
     * @param CallBackUrl       $callBackUrl
     *
     * @return Xml
     *
     * @throws ResponseInvalidException
     */
    public function getProductInventory(StringValueObject $productId, CallBackUrl $callBackUrl);
    
    /**
     * @param StringValueObject  $customerEmail
     * @param IntegerValueObject $timeToLive
     * @param CallBackUrl        $callBackUrl
     *
     * @return Xml
     *
     * @throws ResponseInvalidException
     */
    public function getCustomerLoginToken(
        StringValueObject $customerEmail,
        IntegerValueObject $timeToLive,
        CallBackUrl $callBackUrl
    );
    
    /**
     * @param CallBackUrl $callBackUrl
     *
     * @return Xml
     *
     * @throws ResponseInvalidException
     */
    public function getCustomerCount(CallBackUrl $callBackUrl);
    
    /**
     * @param StringValueObject $customerData
     * @param CustomerAction    $action
     * @param CallBackUrl       $callBackUrl
     *
     * @return Xml
     *
     * @throws ResponseInvalidException
     */
    public function editCustomer(
        StringValueObject $customerData,
        CustomerAction $action,
        CallBackUrl $callBackUrl
    );
    
    /**
     * @param BooleanValueObject $startFrom
     * @param StringValueObject  $invoiceNum
     * @param StringValueObject  $status
     * @param \DateTime |null    $dateFrom
     * @param \DateTime |null    $dateTo
     * @param CallBackUrl |null  $callBackUrl
     *
     * @return Xml
     *
     * @throws ResponseInvalidException
     */
    public function getOrderCount(
        BooleanValueObject $startFrom,
        StringValueObject $invoiceNum,
        StringValueObject $status,
        \DateTime $dateFrom = null,
        \DateTime $dateTo = null,
        CallBackUrl $callBackUrl = null
    );
    
    /**
     * @param BatchSize          $batchSize
     * @param StartNum           $startNum
     * @param BooleanValueObject $startFrom If startFrom is true and invoiceNum is specified,
     *                                      the web service will return orders >= invoiceNum.
     *                                      If startFrom is false and invoiceNum is specified,
     *                                      the web service will return just the specified order.
     *                                      If invoiceNum is not specified, this parameter will be ignored.
     * @param StringValueObject  $invoiceNum
     * @param StringValueObject  $status
     * @param \DateTime |null    $dateFrom
     * @param \DateTime |null    $dateTo
     * @param CallBackUrl |null  $callBackUrl
     *
     * @return Xml
     *
     * @throws ResponseBodyEmptyException
     */
    public function getOrders(
        BatchSize $batchSize,
        StartNum $startNum,
        BooleanValueObject $startFrom,
        StringValueObject $invoiceNum,
        StringValueObject $status,
        \DateTime $dateFrom = null,
        \DateTime $dateTo = null,
        CallBackUrl $callBackUrl = null
    );
    
    /**
     * @param StringValueObject  $productId
     * @param IntegerValueObject $quantity
     * @param BooleanValueObject $replaceStock
     * @param CallBackUrl        $callBackUrl
     *
     * @return Xml
     *
     * @throws ResponseInvalidException
     */
    public function updateProductInventory(
        StringValueObject $productId,
        IntegerValueObject $quantity,
        BooleanValueObject $replaceStock,
        CallBackUrl $callBackUrl
    );
    
    /**
     * @param StringValueObject $invoiceNum
     * @param StringValueObject $newStatus
     * @param CallBackUrl       $callBackUrl
     *
     * @return Xml
     *
     * @throws ResponseBodyEmptyException
     */
    public function updateOrderStatus(
        StringValueObject $invoiceNum,
        StringValueObject $newStatus,
        CallBackUrl $callBackUrl
    );
    
    /**
     * @param StringValueObject $invoiceNum
     * @param StringValueObject $shipmentID
     * @param StringValueObject $tracking
     * @param \DateTime         $shipmentDate
     * @param CallBackUrl       $callBackUrl
     *
     * @return Xml
     *
     * @throws ResponseInvalidException
     */
    public function updateOrderShipment(
        StringValueObject $invoiceNum,
        StringValueObject $shipmentID,
        StringValueObject $tracking,
        \DateTime $shipmentDate,
        CallBackUrl $callBackUrl
    );
}
