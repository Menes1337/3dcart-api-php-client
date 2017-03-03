<?php

namespace ThreeDCart\Api\Soap\Client\Request;

class PhpDefault extends \SoapClient implements MethodsInterface
{
    const THREEDCART_SOAP_API_URL = 'http://api.3dcart.com/cart.asmx';
    
    /** @var string */
    private $threeDCartApiKey;
    /** @var string */
    private $threeDCartStoreUrl;
    
    /**
     * @param string $threeDCartStoreUrl
     * @param string $threeDCartApiKey
     */
    public function __construct($threeDCartStoreUrl, $threeDCartApiKey)
    {
        $this->threeDCartStoreUrl = $threeDCartStoreUrl;
        $this->threeDCartApiKey   = $threeDCartApiKey;
        
        parent::__construct(self::THREEDCART_SOAP_API_URL . '?WSDL',
            array(
                'cache_wsdl'   => WSDL_CACHE_MEMORY,
                'soap_version' => SOAP_1_2
            ));
    }
    
    /**
     * @param int    $batchSize
     * @param int    $startNum
     * @param string $productId
     * @param string $callBackUrl
     *
     * @return \stdClass $stdClass has property getProductResult
     */
    public function getProduct($batchSize, $startNum, $productId, $callBackUrl)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return parent::getProduct(array(
            'storeUrl'    => $this->threeDCartStoreUrl,
            'userKey'     => $this->threeDCartApiKey,
            'batchSize'   => $batchSize,
            'startNum'    => $startNum,
            'productId'   => $productId,
            'callBackURL' => $callBackUrl
        ));
    }
    
    /**
     * @param int    $batchSize
     * @param int    $startNum
     * @param string $customersFilter
     * @param string $callBackUrl
     *
     * @return \stdClass $stdClass has property getCustomerResult
     */
    public function getCustomers($batchSize = 100, $startNum = 1, $customersFilter = '', $callBackUrl = '')
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return parent::getCustomer(array(
            'storeUrl'        => $this->threeDCartStoreUrl,
            'userKey'         => $this->threeDCartApiKey,
            'batchSize'       => $batchSize,
            'startNum'        => $startNum,
            'customersFilter' => $customersFilter,
            'callBackURL'     => $callBackUrl
        ));
    }
    
    /**
     * @param int    $invoiceNum
     * @param string $callBackUrl
     *
     * @return \stdClass $stdClass has property getOrderStatusResult
     */
    public function getOrderStatus($invoiceNum, $callBackUrl = '')
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return parent::getOrderStatus(array(
            'storeUrl'    => $this->threeDCartStoreUrl,
            'userKey'     => $this->threeDCartApiKey,
            'invoiceNum'  => $invoiceNum,
            'callBackURL' => $callBackUrl
        ));
    }
    
    /**
     * @param string $callBackUrl
     *
     * @return \stdClass $stdClass has property getProductCountResult
     */
    public function getProductCount($callBackUrl = '')
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return parent::getProductCount(array(
            'storeUrl'    => $this->threeDCartStoreUrl,
            'userKey'     => $this->threeDCartApiKey,
            'callBackURL' => $callBackUrl
        ));
    }
    
    /**
     * @param int    $productId
     * @param string $callBackUrl
     *
     * @return \stdClass $stdClass has property getProductInventory
     */
    public function getProductInventory($productId, $callBackUrl = '')
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return parent::getProductInventory(array(
            'storeUrl'    => $this->threeDCartStoreUrl,
            'userKey'     => $this->threeDCartApiKey,
            'productId'   => $productId,
            'callBackURL' => $callBackUrl
        ));
    }
    
    /**
     * @param string $customerEmail
     * @param int    $timeToLive
     * @param string $callBackUrl
     *
     * @return \stdClass $stdClass has property getProductInventory
     */
    public function getCustomerLoginToken($customerEmail, $timeToLive, $callBackUrl = '')
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return parent::getCustomerLoginToken(array(
            'storeUrl'      => $this->threeDCartStoreUrl,
            'userKey'       => $this->threeDCartApiKey,
            'customerEmail' => $customerEmail,
            'timeToLive'    => $timeToLive,
            'callBackURL'   => $callBackUrl
        ));
    }
    
    /**
     * @param string $callBackUrl
     *
     * @return \stdClass $stdClass has property getCustomerCountResult
     */
    public function getCustomerCount($callBackUrl = '')
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return parent::getCustomerCount(array(
            'storeUrl'    => $this->threeDCartStoreUrl,
            'userKey'     => $this->threeDCartApiKey,
            'callBackURL' => $callBackUrl
        ));
    }
    
    /**
     * @param bool   $startFrom
     * @param string $invoiceNum
     * @param string $status
     * @param string $dateFrom
     * @param string $dateTo
     * @param string $callBackUrl
     *
     * @return \stdClass $stdClass has property getOrderCountResult
     */
    public function getOrderCount(
        $startFrom = true,
        $invoiceNum = '',
        $status = '',
        $dateFrom = '',
        $dateTo = '',
        $callBackUrl = ''
    ) {
        /** @noinspection PhpUndefinedMethodInspection */
        return parent::getOrderCount(array(
            'storeUrl'    => $this->threeDCartStoreUrl,
            'userKey'     => $this->threeDCartApiKey,
            'startFrom'   => $startFrom,
            'invoiceNum'  => $invoiceNum,
            'status'      => $status,
            'dateFrom'    => $dateFrom,
            'dateTo'      => $dateTo,
            'callBackURL' => $callBackUrl
        ));
    }
    
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
     * @return \stdClass $stdClass has property getOrderResult
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
    ) {
        /** @noinspection PhpUndefinedMethodInspection */
        return parent::getOrder(array(
            'storeUrl'    => $this->threeDCartStoreUrl,
            'userKey'     => $this->threeDCartApiKey,
            'batchSize'   => $batchSize,
            'startNum'    => $startNum,
            'startFrom'   => $startFrom,
            'invoiceNum'  => $invoiceNum,
            'status'      => $status,
            'dateFrom'    => $dateFrom,
            'dateTo'      => $dateTo,
            'callBackURL' => $callBackUrl
        ));
    }
    
    /**
     * @param string $productId
     * @param int    $quantity
     * @param bool   $replaceStock
     * @param string $callBackUrl
     *
     * @return \stdClass $stdClass has property updateProductInventoryResult
     */
    public function updateProductInventory($productId, $quantity, $replaceStock = true, $callBackUrl = '')
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return parent::updateProductInventory(array(
            'storeUrl'     => $this->threeDCartStoreUrl,
            'userKey'      => $this->threeDCartApiKey,
            'productId'    => $productId,
            'quantity'     => $quantity,
            'replaceStock' => $replaceStock,
            'callBackURL'  => $callBackUrl
        ));
    }
    
    /**
     * @param string $invoiceNum
     * @param string $newStatus
     * @param string $callBackUrl
     *
     * @return \stdClass $stdClass has property updateOrderStatusResult
     */
    public function updateOrderStatus($invoiceNum, $newStatus, $callBackUrl = '')
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return parent::updateOrderStatus(array(
            'storeUrl'    => $this->threeDCartStoreUrl,
            'userKey'     => $this->threeDCartApiKey,
            'invoiceNum'  => $invoiceNum,
            'newStatus'   => $newStatus,
            'callBackURL' => $callBackUrl
        ));
    }
    
    /**
     * @param string $invoiceNum
     * @param string $shipmentID
     * @param string $tracking
     * @param string $shipmentDate
     * @param string $callBackUrl
     *
     * @return \stdClass $stdClass has property updateOrderShipmentResult
     */
    public function updateOrderShipment($invoiceNum, $shipmentID, $tracking, $shipmentDate, $callBackUrl = '')
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return parent::updateOrderShipment(array(
            'storeUrl'     => $this->threeDCartStoreUrl,
            'userKey'      => $this->threeDCartApiKey,
            'invoiceNum'   => $invoiceNum,
            'shipmentID'   => $shipmentID,
            'tracking'     => $tracking,
            'shipmentDate' => $shipmentDate,
            'callBackURL'  => $callBackUrl
        ));
    }
    
    /**
     * @param string $customerData
     * @param string $action
     * @param string $callBackUrl
     *
     * @return \stdClass $stdClass has property editCustomerResult
     */
    public function editCustomer($customerData, $action, $callBackUrl)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return parent::editCustomer(array(
            'storeUrl'     => $this->threeDCartStoreUrl,
            'userKey'      => $this->threeDCartApiKey,
            'customerData' => $customerData,
            'action'       => $action,
            'callBackURL'  => $callBackUrl
        ));
    }
}
