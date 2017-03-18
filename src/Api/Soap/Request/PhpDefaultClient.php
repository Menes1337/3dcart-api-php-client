<?php

namespace ThreeDCart\Api\Soap\Request;

use ThreeDCart\Api\Soap\Parameter\BatchSize;
use ThreeDCart\Api\Soap\Parameter\CallBackUrl;
use ThreeDCart\Api\Soap\Parameter\CustomerAction;
use ThreeDCart\Api\Soap\Parameter\StartNum;
use ThreeDCart\Api\Soap\Response\Xml;
use ThreeDCart\Primitive\BooleanValueObject;
use ThreeDCart\Primitive\DateFormat;
use ThreeDCart\Primitive\IntegerValueObject;
use ThreeDCart\Primitive\StringValueObject;

/**
 * Class PhpDefaultClient
 *
 * @package ThreeDCart\Api\Soap\Request
 */
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
    
    public function getProduct(
        BatchSize $batchSize,
        StartNum $startNum,
        StringValueObject $productId,
        CallBackUrl $callBackUrl
    ) {
        /** @noinspection PhpUndefinedMethodInspection */
        $soapResponse = $this->soapClient->getProduct(array(
            'storeUrl'    => $this->threeDCartStoreUrl->getValue(),
            'userKey'     => $this->threeDCartApiKey->getValue(),
            'batchSize'   => $batchSize->getValue(),
            'startNum'    => $startNum->getValue(),
            'productId'   => $productId->getValue(),
            'callBackURL' => $callBackUrl->getValue()
        ));
        
        $this->checkEmptyResponse($soapResponse, new StringValueObject(self::THREEDCART_GET_PRODUCT_RESULT_FIELD));
        
        return new Xml(new StringValueObject($soapResponse->getProductResult->any));
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
    
    /**
     * @param BatchSize|IntegerValueObject $batchSize
     * @param StartNum|IntegerValueObject  $startNum
     * @param StringValueObject            $customersFilter
     * @param CallBackUrl                  $callBackUrl
     *
     * @return Xml
     */
    public function getCustomers(
        BatchSize $batchSize,
        StartNum $startNum,
        StringValueObject $customersFilter,
        CallBackUrl $callBackUrl
    ) {
        /** @noinspection PhpUndefinedMethodInspection */
        $soapResponse = $this->soapClient->getCustomer(array(
            'storeUrl'        => $this->threeDCartStoreUrl->getValue(),
            'userKey'         => $this->threeDCartApiKey->getValue(),
            'batchSize'       => $batchSize->getValue(),
            'startNum'        => $startNum->getValue(),
            'customersFilter' => $customersFilter->getValue(),
            'callBackURL'     => $callBackUrl->getValue()
        ));
        
        $this->checkEmptyResponse($soapResponse, new StringValueObject(self::THREEDCART_GET_CUSTOMER_RESULT_FIELD));
        
        return new Xml(new StringValueObject($soapResponse->{self::THREEDCART_GET_CUSTOMER_RESULT_FIELD}->any));
    }
    
    /**
     * @param StringValueObject $invoiceNum
     * @param CallBackUrl       $callBackUrl
     *
     * @return Xml
     *
     * @throws ResponseInvalidException
     */
    public function getOrderStatus(StringValueObject $invoiceNum, CallBackUrl $callBackUrl)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $soapResponse = $this->soapClient->getOrderStatus(array(
            'storeUrl'    => $this->threeDCartStoreUrl->getValue(),
            'userKey'     => $this->threeDCartApiKey->getValue(),
            'invoiceNum'  => $invoiceNum->getValue(),
            'callBackURL' => $callBackUrl->getValue()
        ));
        
        $this->checkEmptyResponse($soapResponse, new StringValueObject(self::THREEDCART_GET_ORDER_RESULT_FIELD));
        
        return new Xml(new StringValueObject($soapResponse->{self::THREEDCART_GET_ORDER_RESULT_FIELD}->any));
    }
    
    /**
     * @param CallBackUrl $callBackUrl
     *
     * @return Xml
     *
     * @throws ResponseInvalidException
     */
    public function getProductCount(CallBackUrl $callBackUrl)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $soapResponse = $this->soapClient->getProductCount(array(
            'storeUrl'    => $this->threeDCartStoreUrl->getValue(),
            'userKey'     => $this->threeDCartApiKey->getValue(),
            'callBackURL' => $callBackUrl->getValue()
        ));
        
        $this->checkEmptyResponse(
            $soapResponse,
            new StringValueObject(self::THREEDCART_GET_PRODUCT_COUNT_RESULT_FIELD)
        );
        
        return new Xml(new StringValueObject($soapResponse->{self::THREEDCART_GET_PRODUCT_COUNT_RESULT_FIELD}->any));
    }
    
    /**
     * @param StringValueObject $productId
     * @param CallBackUrl       $callBackUrl
     *
     * @return Xml
     *
     * @throws ResponseInvalidException
     */
    public function getProductInventory(StringValueObject $productId, CallBackUrl $callBackUrl)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $soapResponse = $this->soapClient->getProductInventory(array(
            'storeUrl'    => $this->threeDCartStoreUrl->getValue(),
            'userKey'     => $this->threeDCartApiKey->getValue(),
            'productId'   => $productId->getValue(),
            'callBackURL' => $callBackUrl->getValue()
        ));
        
        $this->checkEmptyResponse(
            $soapResponse,
            new StringValueObject(self::THREEDCART_GET_PRODUCT_INVENTORY_RESULT_FIELD)
        );
        
        return new Xml(new StringValueObject($soapResponse->{self::THREEDCART_GET_PRODUCT_INVENTORY_RESULT_FIELD}->any));
        
    }
    
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
    ) {
        /** @noinspection PhpUndefinedMethodInspection */
        $soapResponse = $this->soapClient->getCustomerLoginToken(array(
            'storeUrl'      => $this->threeDCartStoreUrl->getValue(),
            'userKey'       => $this->threeDCartApiKey->getValue(),
            'customerEmail' => $customerEmail->getValue(),
            'timeToLive'    => $timeToLive->getValue(),
            'callBackURL'   => $callBackUrl->getValue()
        ));
        
        $this->checkEmptyResponse(
            $soapResponse,
            new StringValueObject(self::THREEDCART_GET_CUSTOMER_LOGIN_TOKEN_RESULT_FIELD)
        );
        
        return new Xml(new StringValueObject($soapResponse->{self::THREEDCART_GET_CUSTOMER_LOGIN_TOKEN_RESULT_FIELD}->any));
        
    }
    
    /**
     * @param CallBackUrl $callBackUrl
     *
     * @return Xml
     *
     * @throws ResponseInvalidException
     */
    public function getCustomerCount(CallBackUrl $callBackUrl)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $soapResponse = $this->soapClient->getCustomerCount(array(
            'storeUrl'    => $this->threeDCartStoreUrl->getValue(),
            'userKey'     => $this->threeDCartApiKey->getValue(),
            'callBackURL' => $callBackUrl->getValue()
        ));
        
        $this->checkEmptyResponse(
            $soapResponse,
            new StringValueObject(self::THREEDCART_GET_CUSTOMER_COUNT_RESULT_FIELD)
        );
        
        return new Xml(new StringValueObject($soapResponse->{self::THREEDCART_GET_CUSTOMER_COUNT_RESULT_FIELD}->any));
    }
    
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
    ) {
        /** @noinspection PhpUndefinedMethodInspection */
        $soapResponse = $this->soapClient->editCustomer(array(
            'storeUrl'     => $this->threeDCartStoreUrl->getValue(),
            'userKey'      => $this->threeDCartApiKey->getValue(),
            'customerData' => $customerData->getValue(),
            'action'       => $action->getValue(),
            'callBackURL'  => $callBackUrl->getValue()
        ));
        
        $this->checkEmptyResponse(
            $soapResponse,
            new StringValueObject(self::THREEDCART_EDIT_CUSTOMER_RESULT_FIELD)
        );
        
        return new Xml(new StringValueObject($soapResponse->{self::THREEDCART_EDIT_CUSTOMER_RESULT_FIELD}->any));
    }
    
    /**
     * @param BooleanValueObject $startFrom
     * @param StringValueObject  $invoiceNum
     * @param StringValueObject  $status
     * @param \DateTime | null   $dateFrom
     * @param \DateTime | null   $dateTo
     * @param CallBackUrl | null $callBackUrl
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
    ) {
        /** @noinspection PhpUndefinedMethodInspection */
        $soapResponse = $this->soapClient->getOrderCount(array(
            'storeUrl'    => $this->threeDCartStoreUrl->getValue(),
            'userKey'     => $this->threeDCartApiKey->getValue(),
            'startFrom'   => $startFrom->getValue(),
            'invoiceNum'  => $invoiceNum->getValue(),
            'status'      => $status->getValue(),
            'dateFrom'    => !empty($dateFrom) ? $dateFrom->format(DateFormat::THREE_D_CART_API_DATE_FORMAT) : '',
            'dateTo'      => !empty($dateTo) ? $dateTo->format(DateFormat::THREE_D_CART_API_DATE_FORMAT) : '',
            'callBackURL' => !empty($callBackUrl) ? $callBackUrl->getValue() : ''
        ));
        
        $this->checkEmptyResponse(
            $soapResponse,
            new StringValueObject(self::THREEDCART_GET_ORDER_COUNT_RESULT_FIELD)
        );
        
        return new Xml(new StringValueObject($soapResponse->{self::THREEDCART_GET_ORDER_COUNT_RESULT_FIELD}->any));
    }
    
    /**
     * @param BatchSize          $batchSize
     * @param StartNum           $startNum
     * @param BooleanValueObject $startFrom
     * @param StringValueObject  $invoiceNum
     * @param StringValueObject  $status
     * @param \DateTime | null   $dateFrom
     * @param \DateTime | null   $dateTo
     * @param CallBackUrl | null $callBackUrl
     *
     * @return Xml
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
    ) {
        /** @noinspection PhpUndefinedMethodInspection */
        $soapResponse = $this->soapClient->getOrder(array(
            'storeUrl'    => $this->threeDCartStoreUrl->getValue(),
            'userKey'     => $this->threeDCartApiKey->getValue(),
            'batchSize'   => $batchSize->getValue(),
            'startNum'    => $startNum->getValue(),
            'startFrom'   => $startFrom->getValue(),
            'invoiceNum'  => $invoiceNum->getValue(),
            'status'      => $status->getValue(),
            'dateFrom'    => !empty($dateFrom) ? $dateFrom->format(DateFormat::THREE_D_CART_API_DATE_FORMAT) : '',
            'dateTo'      => !empty($dateTo) ? $dateTo->format(DateFormat::THREE_D_CART_API_DATE_FORMAT) : '',
            'callBackURL' => !empty($callBackUrl) ? $callBackUrl->getValue() : ''
        ));
        
        $this->checkEmptyResponse(
            $soapResponse,
            new StringValueObject(self::THREEDCART_GET_ORDER_RESULT_FIELD)
        );
        
        return new Xml(new StringValueObject($soapResponse->{self::THREEDCART_GET_ORDER_RESULT_FIELD}->any));
    }
    
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
    ) {
        /** @noinspection PhpUndefinedMethodInspection */
        $soapResponse = $this->soapClient->updateProductInventory(array(
            'storeUrl'     => $this->threeDCartStoreUrl->getValue(),
            'userKey'      => $this->threeDCartApiKey->getValue(),
            'productId'    => $productId->getValue(),
            'quantity'     => $quantity->getValue(),
            'replaceStock' => $replaceStock->getValue(),
            'callBackURL'  => $callBackUrl->getValue()
        ));
        
        $this->checkEmptyResponse(
            $soapResponse,
            new StringValueObject(self::THREEDCART_UPDATE_PRODUCT_INVENTORY_RESULT_FIELD)
        );
        
        return new Xml(new StringValueObject($soapResponse->{self::THREEDCART_UPDATE_PRODUCT_INVENTORY_RESULT_FIELD}->any));
    }
    
    /**
     * @param StringValueObject $invoiceNum
     * @param StringValueObject $newStatus
     * @param CallBackUrl       $callBackUrl
     *
     * @return Xml
     */
    public function updateOrderStatus(
        StringValueObject $invoiceNum,
        StringValueObject $newStatus,
        CallBackUrl $callBackUrl
    ) {
        /** @noinspection PhpUndefinedMethodInspection */
        $soapResponse = $this->soapClient->updateOrderStatus(array(
            'storeUrl'    => $this->threeDCartStoreUrl->getValue(),
            'userKey'     => $this->threeDCartApiKey->getValue(),
            'invoiceNum'  => $invoiceNum->getValue(),
            'newStatus'   => $newStatus->getValue(),
            'callBackURL' => $callBackUrl->getValue()
        ));
        
        $this->checkEmptyResponse(
            $soapResponse,
            new StringValueObject(self::THREEDCART_UPDATE_ORDER_STATUS_RESULT_FIELD)
        );
        
        return new Xml(new StringValueObject($soapResponse->{self::THREEDCART_UPDATE_ORDER_STATUS_RESULT_FIELD}->any));
    }
    
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
    ) {
        /** @noinspection PhpUndefinedMethodInspection */
        $soapResponse = $this->soapClient->updateOrderShipment(array(
            'storeUrl'     => $this->threeDCartStoreUrl->getValue(),
            'userKey'      => $this->threeDCartApiKey->getValue(),
            'invoiceNum'   => $invoiceNum->getValue(),
            'shipmentID'   => $shipmentID->getValue(),
            'tracking'     => $tracking->getValue(),
            'shipmentDate' => $shipmentDate->format(DateFormat::THREE_D_CART_API_DATE_FORMAT),
            'callBackURL'  => $callBackUrl->getValue()
        ));
        
        $this->checkEmptyResponse(
            $soapResponse,
            new StringValueObject(self::THREEDCART_UPDATE_ORDER_SHIPMENT_RESULT_FIELD)
        );
        
        return new Xml(new StringValueObject($soapResponse->{self::THREEDCART_UPDATE_ORDER_SHIPMENT_RESULT_FIELD}->any));
    }
}
