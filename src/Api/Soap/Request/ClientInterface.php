<?php

namespace ThreeDCart\Api\Soap\Request;

use ThreeDCart\Api\Soap\Response\Xml;

interface ClientInterface
{
    /**
     * @param int    $batchSize
     * @param int    $startNum
     * @param string $productId
     * @param string $callBackUrl
     *
     * @return Xml
     *
     * @throws ResponseInvalidException
     */
    public function getProduct($batchSize, $startNum, $productId, $callBackUrl);
    
    /**
     * @param int    $batchSize
     * @param int    $startNum
     * @param string $customersFilter
     * @param string $callBackUrl
     *
     * @return Xml
     *
     * @throws ResponseInvalidException
     */
    public function getCustomers($batchSize = 100, $startNum = 1, $customersFilter = '', $callBackUrl = '');
    
    /**
     * @param int    $invoiceNum
     * @param string $callBackUrl
     *
     * @return Xml
     *
     * @throws ResponseInvalidException
     */
    public function getOrderStatus($invoiceNum, $callBackUrl = '');
    
    /**
     * @param string $callBackUrl
     *
     * @return Xml
     *
     * @throws ResponseInvalidException
     */
    public function getProductCount($callBackUrl = '');
    
    /**
     * @param int    $productId
     * @param string $callBackUrl
     *
     * @return Xml
     *
     * @throws ResponseInvalidException
     */
    public function getProductInventory($productId, $callBackUrl = '');
    
    /**
     * @param string $customerEmail
     * @param int    $timeToLive
     * @param string $callBackUrl
     *
     * @return Xml
     *
     * @throws ResponseInvalidException
     */
    public function getCustomerLoginToken($customerEmail, $timeToLive, $callBackUrl = '');
    
    /**
     * @param string $callBackUrl
     *
     * @return Xml
     *
     * @throws ResponseInvalidException
     */
    public function getCustomerCount($callBackUrl = '');
    
    /**
     * @param string $customerData
     * @param string $action
     * @param string $callBackUrl
     *
     * @return Xml
     *
     * @throws ResponseInvalidException
     */
    public function editCustomer($customerData, $action, $callBackUrl);
    
    /**
     * @param bool   $startFrom
     * @param string $invoiceNum
     * @param string $status
     * @param string $dateFrom
     * @param string $dateTo
     * @param string $callBackUrl
     *
     * @return Xml
     *
     * @throws ResponseInvalidException
     */
    public function getOrderCount(
        $startFrom = true,
        $invoiceNum = '',
        $status = '',
        $dateFrom = '',
        $dateTo = '',
        $callBackUrl = ''
    );
    
    /**
     * @param int    $batchSize
     * @param int    $startNum
     * @param bool   $startFrom
     * @param string $invoiceNum
     * @param string $status
     * @param string $dateFrom
     * @param string $dateTo
     * @param string $callBackUrl
     *
     * @return Xml
     *
     * @throws ResponseInvalidException
     */
    public function getOrders(
        $batchSize = 200,
        $startNum = 100,
        $startFrom = true,
        $invoiceNum = '',
        $status = '',
        $dateFrom = '',
        $dateTo = '',
        $callBackUrl = ''
    );
    
    /**
     * @param string $productId
     * @param int    $quantity
     * @param bool   $replaceStock
     * @param string $callBackUrl
     *
     * @return Xml
     *
     * @throws ResponseInvalidException
     */
    public function updateProductInventory($productId, $quantity, $replaceStock = true, $callBackUrl = '');
    
    /**
     * @param string $invoiceNum
     * @param string $newStatus
     * @param string $callBackUrl
     *
     * @return Xml
     */
    public function updateOrderStatus($invoiceNum, $newStatus, $callBackUrl = '');
    
    /**
     * @param string $invoiceNum
     * @param string $shipmentID
     * @param string $tracking
     * @param string $shipmentDate
     * @param string $callBackUrl
     *
     * @return Xml
     *
     * @throws ResponseInvalidException
     */
    public function updateOrderShipment($invoiceNum, $shipmentID, $tracking, $shipmentDate, $callBackUrl = '');
}
