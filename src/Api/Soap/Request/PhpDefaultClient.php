<?php

namespace ThreeDCart\Api\Soap\Request;

use ThreeDCart\Api\Soap\Response\Xml;
use ThreeDCart\Primitive\StringValueObject;

class PhpDefaultClient implements ClientInterface
{
    const THREEDCART_GET_PRODUCT_RESULT_FIELD              = 'getProductResult';
    const THREEDCART_GET_CUSTOMER_RESULT_FIELD             = 'getCustomerResult';
    const THREEDCART_GET_ORDER_STATUS_RESULT_FIELD         = 'getOrderStatusResult';
    const THREEDCART_GET_PRODUCT_COUNT_RESULT_FIELD        = 'getProductCountResult';
    const THREEDCART_GET_PRODUCT_INVENTORY_RESULT_FIELD    = 'getProductInventoryResult';
    const THREEDCART_GET_CUSTOMER_LOGIN_TOKEN_RESULT_FIELD = 'getCustomerLoginTokenResult';
    const THREEDCART_GET_CUSTOMER_COUNT_RESULT_FIELD       = 'getCustomerCountResult';
    const THREEDCART_GET_ORDER_COUNT_RESULT_FIELD          = 'getOrderCountResult';
    const THREEDCART_GET_ORDER_RESULT_FIELD                = 'getOrderResult';
    const THREEDCART_UPDATE_PRODUCT_INVENTORY_RESULT_FIELD = 'updateProductInventoryResult';
    const THREEDCART_UPDATE_ORDER_STATUS_RESULT_FIELD      = 'updateOrderStatusResult';
    const THREEDCART_UPDATE_ORDER_SHIPMENT_RESULT_FIELD    = 'updateOrderShipmentResult';
    const THREEDCART_EDIT_CUSTOMER_RESULT_FIELD            = 'editCustomerResult';
    
    /** @var StringValueObject */
    private $threeDCartApiKey;
    /** @var StringValueObject */
    private $threeDCartStoreUrl;
    /** @var ResponseHandler */
    private $responseHandler;
    /** @var \SoapClient */
    private $soapClient;
    
    /**
     * @param \SoapClient       $soapClient
     * @param ResponseHandler   $responseHandler
     * @param StringValueObject $threeDCartStoreUrl
     * @param StringValueObject $threeDCartApiKey
     */
    public function __construct(
        \SoapClient $soapClient,
        ResponseHandler $responseHandler,
        StringValueObject $threeDCartStoreUrl,
        StringValueObject $threeDCartApiKey
    ) {
        $this->responseHandler    = $responseHandler;
        $this->threeDCartStoreUrl = $threeDCartStoreUrl;
        $this->threeDCartApiKey   = $threeDCartApiKey;
        $this->soapClient         = $soapClient;
    }
    
    public function getProduct($batchSize, $startNum, $productId, $callBackUrl)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $soapResponse = $this->soapClient->getProduct(array(
            'storeUrl'    => $this->threeDCartStoreUrl->getValue(),
            'userKey'     => $this->threeDCartApiKey->getValue(),
            'batchSize'   => $batchSize,
            'startNum'    => $startNum,
            'productId'   => $productId,
            'callBackURL' => $callBackUrl
        ));
        
        $this->checkEmptyResponse($soapResponse, new StringValueObject(self::THREEDCART_GET_PRODUCT_RESULT_FIELD));
        
        return new Xml(new StringValueObject($soapResponse->getProductResult->any));
    }
    
    public function getCustomers($batchSize = 100, $startNum = 1, $customersFilter = '', $callBackUrl = '')
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $soapResponse = $this->soapClient->getCustomer(array(
            'storeUrl'        => $this->threeDCartStoreUrl->getValue(),
            'userKey'         => $this->threeDCartApiKey->getValue(),
            'batchSize'       => $batchSize,
            'startNum'        => $startNum,
            'customersFilter' => $customersFilter,
            'callBackURL'     => $callBackUrl
        ));
        
        $this->checkEmptyResponse($soapResponse, new StringValueObject(self::THREEDCART_GET_CUSTOMER_RESULT_FIELD));
        
        return new Xml(new StringValueObject($soapResponse->{self::THREEDCART_GET_CUSTOMER_RESULT_FIELD}->any));
    }
    
    public function getOrderStatus($invoiceNum, $callBackUrl = '')
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $soapResponse = $this->soapClient->getOrderStatus(array(
            'storeUrl'    => $this->threeDCartStoreUrl->getValue(),
            'userKey'     => $this->threeDCartApiKey->getValue(),
            'invoiceNum'  => $invoiceNum,
            'callBackURL' => $callBackUrl
        ));
        
        $this->checkEmptyResponse($soapResponse, new StringValueObject(self::THREEDCART_GET_ORDER_RESULT_FIELD));
        
        return new Xml(new StringValueObject($soapResponse->{self::THREEDCART_GET_ORDER_RESULT_FIELD}->any));
    }
    
    public function getProductCount($callBackUrl = '')
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $soapResponse = $this->soapClient->getProductCount(array(
            'storeUrl'    => $this->threeDCartStoreUrl->getValue(),
            'userKey'     => $this->threeDCartApiKey->getValue(),
            'callBackURL' => $callBackUrl
        ));
        
        $this->checkEmptyResponse(
            $soapResponse,
            new StringValueObject(self::THREEDCART_GET_PRODUCT_COUNT_RESULT_FIELD)
        );
        
        return new Xml(new StringValueObject($soapResponse->{self::THREEDCART_GET_PRODUCT_COUNT_RESULT_FIELD}->any));
    }
    
    public function getProductInventory($productId, $callBackUrl = '')
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $soapResponse = $this->soapClient->getProductInventory(array(
            'storeUrl'    => $this->threeDCartStoreUrl->getValue(),
            'userKey'     => $this->threeDCartApiKey->getValue(),
            'productId'   => $productId,
            'callBackURL' => $callBackUrl
        ));
        
        $this->checkEmptyResponse(
            $soapResponse,
            new StringValueObject(self::THREEDCART_GET_PRODUCT_INVENTORY_RESULT_FIELD)
        );
        
        return new Xml(new StringValueObject($soapResponse->{self::THREEDCART_GET_PRODUCT_INVENTORY_RESULT_FIELD}->any));
    }
    
    public function getCustomerLoginToken($customerEmail, $timeToLive, $callBackUrl = '')
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $soapResponse = $this->soapClient->getCustomerLoginToken(array(
            'storeUrl'      => $this->threeDCartStoreUrl->getValue(),
            'userKey'       => $this->threeDCartApiKey->getValue(),
            'customerEmail' => $customerEmail,
            'timeToLive'    => $timeToLive,
            'callBackURL'   => $callBackUrl
        ));
        
        $this->checkEmptyResponse(
            $soapResponse,
            new StringValueObject(self::THREEDCART_GET_CUSTOMER_LOGIN_TOKEN_RESULT_FIELD)
        );
        
        return new Xml(new StringValueObject($soapResponse->{self::THREEDCART_GET_CUSTOMER_LOGIN_TOKEN_RESULT_FIELD}->any));
    }
    
    public function getCustomerCount($callBackUrl = '')
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $soapResponse = $this->soapClient->getCustomerCount(array(
            'storeUrl'    => $this->threeDCartStoreUrl->getValue(),
            'userKey'     => $this->threeDCartApiKey->getValue(),
            'callBackURL' => $callBackUrl
        ));
        
        $this->checkEmptyResponse(
            $soapResponse,
            new StringValueObject(self::THREEDCART_GET_CUSTOMER_COUNT_RESULT_FIELD)
        );
        
        return new Xml(new StringValueObject($soapResponse->{self::THREEDCART_GET_CUSTOMER_COUNT_RESULT_FIELD}->any));
    }
    
    public function getOrderCount(
        $startFrom = true,
        $invoiceNum = '',
        $status = '',
        $dateFrom = '',
        $dateTo = '',
        $callBackUrl = ''
    ) {
        /** @noinspection PhpUndefinedMethodInspection */
        $soapResponse = $this->soapClient->getOrderCount(array(
            'storeUrl'    => $this->threeDCartStoreUrl->getValue(),
            'userKey'     => $this->threeDCartApiKey->getValue(),
            'startFrom'   => $startFrom,
            'invoiceNum'  => $invoiceNum,
            'status'      => $status,
            'dateFrom'    => $dateFrom,
            'dateTo'      => $dateTo,
            'callBackURL' => $callBackUrl
        ));
        
        $this->checkEmptyResponse(
            $soapResponse,
            new StringValueObject(self::THREEDCART_GET_ORDER_COUNT_RESULT_FIELD)
        );
        
        return new Xml(new StringValueObject($soapResponse->{self::THREEDCART_GET_ORDER_COUNT_RESULT_FIELD}->any));
    }
    
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
        $soapResponse = $this->soapClient->getOrder(array(
            'storeUrl'    => $this->threeDCartStoreUrl->getValue(),
            'userKey'     => $this->threeDCartApiKey->getValue(),
            'batchSize'   => $batchSize,
            'startNum'    => $startNum,
            'startFrom'   => $startFrom,
            'invoiceNum'  => $invoiceNum,
            'status'      => $status,
            'dateFrom'    => $dateFrom,
            'dateTo'      => $dateTo,
            'callBackURL' => $callBackUrl
        ));
        
        $this->checkEmptyResponse(
            $soapResponse,
            new StringValueObject(self::THREEDCART_GET_ORDER_RESULT_FIELD)
        );
        
        return new Xml(new StringValueObject($soapResponse->{self::THREEDCART_GET_ORDER_RESULT_FIELD}->any));
    }
    
    public function updateProductInventory($productId, $quantity, $replaceStock = true, $callBackUrl = '')
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $soapResponse = $this->soapClient->updateProductInventory(array(
            'storeUrl'     => $this->threeDCartStoreUrl->getValue(),
            'userKey'      => $this->threeDCartApiKey->getValue(),
            'productId'    => $productId,
            'quantity'     => $quantity,
            'replaceStock' => $replaceStock,
            'callBackURL'  => $callBackUrl
        ));
        
        $this->checkEmptyResponse(
            $soapResponse,
            new StringValueObject(self::THREEDCART_UPDATE_PRODUCT_INVENTORY_RESULT_FIELD)
        );
        
        return new Xml(new StringValueObject($soapResponse->{self::THREEDCART_UPDATE_PRODUCT_INVENTORY_RESULT_FIELD}->any));
    }
    
    public function updateOrderStatus($invoiceNum, $newStatus, $callBackUrl = '')
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $soapResponse = $this->soapClient->updateOrderStatus(array(
            'storeUrl'    => $this->threeDCartStoreUrl->getValue(),
            'userKey'     => $this->threeDCartApiKey->getValue(),
            'invoiceNum'  => $invoiceNum,
            'newStatus'   => $newStatus,
            'callBackURL' => $callBackUrl
        ));
        
        $this->checkEmptyResponse(
            $soapResponse,
            new StringValueObject(self::THREEDCART_UPDATE_ORDER_STATUS_RESULT_FIELD)
        );
        
        return new Xml(new StringValueObject($soapResponse->{self::THREEDCART_UPDATE_ORDER_STATUS_RESULT_FIELD}->any));
    }
    
    public function updateOrderShipment($invoiceNum, $shipmentID, $tracking, $shipmentDate, $callBackUrl = '')
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $soapResponse = $this->soapClient->updateOrderShipment(array(
            'storeUrl'     => $this->threeDCartStoreUrl->getValue(),
            'userKey'      => $this->threeDCartApiKey->getValue(),
            'invoiceNum'   => $invoiceNum,
            'shipmentID'   => $shipmentID,
            'tracking'     => $tracking,
            'shipmentDate' => $shipmentDate,
            'callBackURL'  => $callBackUrl
        ));
        
        $this->checkEmptyResponse(
            $soapResponse,
            new StringValueObject(self::THREEDCART_UPDATE_ORDER_SHIPMENT_RESULT_FIELD)
        );
        
        return new Xml(new StringValueObject($soapResponse->{self::THREEDCART_UPDATE_ORDER_SHIPMENT_RESULT_FIELD}->any));
    }
    
    public function editCustomer($customerData, $action, $callBackUrl)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $soapResponse = $this->soapClient->editCustomer(array(
            'storeUrl'     => $this->threeDCartStoreUrl->getValue(),
            'userKey'      => $this->threeDCartApiKey->getValue(),
            'customerData' => $customerData,
            'action'       => $action,
            'callBackURL'  => $callBackUrl
        ));
        
        $this->checkEmptyResponse(
            $soapResponse,
            new StringValueObject(self::THREEDCART_EDIT_CUSTOMER_RESULT_FIELD)
        );
        
        return new Xml(new StringValueObject($soapResponse->{self::THREEDCART_EDIT_CUSTOMER_RESULT_FIELD}->any));
    }
    
    /**
     * @param \stdClass         $response
     * @param StringValueObject $field
     *
     * @throws ResponseBodyEmptyException
     */
    public function checkEmptyResponse(\stdClass $response, StringValueObject $field)
    {
        if (empty($response) || empty($response->{$field->getValue()}->any)) {
            throw new ResponseBodyEmptyException('response body is empty');
        }
    }
    
    /**
     * @param \SoapClient $soapClient
     */
    public function setSoapClient(\SoapClient $soapClient)
    {
        $this->soapClient = $soapClient;
    }
}
