<?php

namespace ThreeDCart\Api\Soap;

use ThreeDCart\Api\Soap\Resources\Customer\Customer;
use ThreeDCart\Api\Soap\Resources\Customer\LoginToken;
use ThreeDCart\Api\Soap\Resources\Order\Order;
use ThreeDCart\Api\Soap\Resources\Order\Status;
use ThreeDCart\Api\Soap\Resources\Product\Product;
use ThreeDCart\Api\Soap\Resources\Product\ProductInventory;
use ThreeDCart\Api\Soap\Resources\ResourceParser;

class ApiClient
{
    const THREEDCART_SOAP_API_URL = 'http://api.3dcart.com/cart.asmx';
    
    /** @var string */
    private $threeDCartApiKey;
    /** @var string */
    private $threeDCartStoreUrl;
    /** @var \SoapClient */
    private $soapClient;
    /** @var ResponseHandlerInterface */
    private $responseHandler;
    /** @var ResourceParser */
    private $resourceParser;
    
    /**
     * @param string $threeDCartApiKey
     * @param string $threeDCartStoreUrl
     */
    public function __construct($threeDCartApiKey, $threeDCartStoreUrl)
    {
        $this->threeDCartApiKey   = $threeDCartApiKey;
        $this->threeDCartStoreUrl = $threeDCartStoreUrl;
        
        $this->soapClient      =
            new \SoapClient(
                static::THREEDCART_SOAP_API_URL . '?WSDL',
                array(
                    'cache_wsdl'   => WSDL_CACHE_MEMORY,
                    'soap_version' => SOAP_1_2
                )
            );
        $this->responseHandler = new ResponseHandler();
        $this->resourceParser  = new ResourceParser();
    }
    
    /**
     * @param int    $batchSize
     * @param int    $startNum
     * @param string $productId
     * @param string $callBackUrl
     *
     * @return array
     */
    public function getProducts($batchSize = 100, $startNum = 1, $productId = '', $callBackUrl = '')
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $response = $this->soapClient->getProduct(array(
            'storeUrl'    => $this->threeDCartStoreUrl,
            'userKey'     => $this->threeDCartApiKey,
            'batchSize'   => $batchSize,
            'startNum'    => $startNum,
            'productId'   => $productId,
            'callBackURL' => $callBackUrl
        ));
        
        return $this->resourceParser->getResources(
            Product::class,
            $this->responseHandler->processXMLToArray($response->getProductResult, 'Product')
        );
    }
    
    /**
     * @param int    $batchSize
     * @param int    $startNum
     * @param string $customersFilter
     * @param string $callBackUrl
     *
     * @return array
     */
    public function getCustomers($batchSize = 100, $startNum = 1, $customersFilter = '', $callBackUrl = '')
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $response = $this->soapClient->getCustomer(array(
            'storeUrl'        => $this->threeDCartStoreUrl,
            'userKey'         => $this->threeDCartApiKey,
            'batchSize'       => $batchSize,
            'startNum'        => $startNum,
            'customersFilter' => $customersFilter,
            'callBackURL'     => $callBackUrl
        ));
        
        return $this->resourceParser->getResources(
            Customer::class,
            $this->responseHandler->processXMLToArray($response->getCustomerResult, 'Customer')
        );
    }
    
    /**
     * @param int    $invoiceNum
     * @param string $callBackUrl
     *
     * @return Status
     */
    public function getOrderStatus($invoiceNum, $callBackUrl = '')
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $response = $this->soapClient->getOrderStatus(array(
            'storeUrl'    => $this->threeDCartStoreUrl,
            'userKey'     => $this->threeDCartApiKey,
            'invoiceNum'  => $invoiceNum,
            'callBackURL' => $callBackUrl
        ));
        
        return $this->resourceParser->getResource(
            Status::class,
            $this->responseHandler->processXMLToArray($response->getOrderStatusResult, null)
        );
    }
    
    /**
     * @param string $callBackUrl
     *
     * @return int
     */
    public function getProductCount($callBackUrl = '')
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $response = $this->soapClient->getProductCount(array(
            'storeUrl'    => $this->threeDCartStoreUrl,
            'userKey'     => $this->threeDCartApiKey,
            'callBackURL' => $callBackUrl
        ));
        
        return $this->responseHandler->processXMLToArray($response->getProductCountResult, 'ProductQuantity');
    }
    
    /**
     * @param string $callBackUrl
     *
     * @return ProductInventory
     */
    public function getProductInventory($productId, $callBackUrl = '')
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $response = $this->soapClient->getProductInventory(array(
            'storeUrl'    => $this->threeDCartStoreUrl,
            'userKey'     => $this->threeDCartApiKey,
            'productId'   => $productId,
            'callBackURL' => $callBackUrl
        ));
        
        return $this->resourceParser->getResource(
            ProductInventory::class,
            $this->responseHandler->processXMLToArray($response->getProductInventoryResult, null)
        );
    }
    
    /**
     * @param string $customerEmail
     * @param int    $timeToLive
     * @param string $callBackUrl
     *
     * @return LoginToken
     */
    public function getCustomerLoginToken($customerEmail, $timeToLive, $callBackUrl = '')
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $response = $this->soapClient->getCustomerLoginToken(array(
            'storeUrl'      => $this->threeDCartStoreUrl,
            'userKey'       => $this->threeDCartApiKey,
            'customerEmail' => $customerEmail,
            'timeToLive'    => $timeToLive,
            'callBackURL'   => $callBackUrl
        ));
        
        return $this->resourceParser->getResource(
            LoginToken::class,
            $this->responseHandler->processXMLToArray($response->getCustomerLoginTokenResult, null)
        );
    }
    
    /**
     * @param string $callBackUrl
     *
     * @return int
     */
    public function getCustomerCount($callBackUrl = '')
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $response = $this->soapClient->getCustomerCount(array(
            'storeUrl'    => $this->threeDCartStoreUrl,
            'userKey'     => $this->threeDCartApiKey,
            'callBackURL' => $callBackUrl
        ));
        
        return $this->responseHandler->processXMLToArray($response->getCustomerCountResult, 'CustomerCount');
    }
    
    /**
     * @param string $callBackUrl
     * @param bool   $startFrom
     * @param string $invoiceNum
     * @param string $status
     * @param string $dateFrom
     * @param string $dateTo
     *
     * @return array
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
        $response = $this->soapClient->getOrderCount(array(
            'storeUrl'    => $this->threeDCartStoreUrl,
            'userKey'     => $this->threeDCartApiKey,
            'startFrom'   => $startFrom,
            'invoiceNum'  => $invoiceNum,
            'status'      => $status,
            'dateFrom'    => $dateFrom,
            'dateTo'      => $dateTo,
            'callBackURL' => $callBackUrl
        ));
        
        return $this->responseHandler->processXMLToArray($response->getOrderCountResult, 'Quantity');
    }
    
    /**
     * @param string $callBackUrl
     * @param int    $batchSize
     * @param int    $startNum
     * @param bool   $startFrom
     * @param string $invoiceNum
     * @param string $status
     * @param string $dateFrom
     * @param string $dateTo
     *
     * @return array
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
        $response = $this->soapClient->getOrder(array(
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
        
        return $this->resourceParser->getResources(
            Order::class,
            $this->responseHandler->processXMLToArray($response->getOrderResult, 'Order')
        );
    }
    
    /**
     * @param string $productId
     * @param int    $quantity
     * @param bool   $replaceStock
     * @param string $callBackUrl
     *
     * @return bool
     */
    public function updateProductInventory(
        $productId,
        $quantity,
        $replaceStock = true,
        $callBackUrl = ''
    ) {
        /** @noinspection PhpUndefinedMethodInspection */
        $response = $this->soapClient->updateProductInventory(array(
            'storeUrl'     => $this->threeDCartStoreUrl,
            'userKey'      => $this->threeDCartApiKey,
            'productId'    => $productId,
            'quantity'     => $quantity,
            'replaceStock' => $replaceStock,
            'callBackURL'  => $callBackUrl
        ));
        
        $response = $this->responseHandler->processXMLToArray($response->updateProductInventoryResult, null);
        
        if (isset($response['ProductID']) && $response['ProductID'] == $productId
            && isset($response['NewInventory'])
            && $response['NewInventory'] == $quantity
        ) {
            return true;
        }
        
        return false;
    }
    
    /**
     * @param string $invoiceNum
     * @param string $newStatus
     * @param string $callBackUrl
     *
     * @return bool
     */
    public function updateOrderStatus(
        $invoiceNum,
        $newStatus,
        $callBackUrl = ''
    ) {
        /** @noinspection PhpUndefinedMethodInspection */
        $response = $this->soapClient->updateOrderStatus(array(
            'storeUrl'    => $this->threeDCartStoreUrl,
            'userKey'     => $this->threeDCartApiKey,
            'invoiceNum'  => $invoiceNum,
            'newStatus'   => $newStatus,
            'callBackURL' => $callBackUrl
        ));
        
        $response = $this->responseHandler->processXMLToArray($response->updateOrderStatusResult, null);
        
        if (isset($response['InvoiceNum']) && $response['InvoiceNum'] == $invoiceNum
            && isset($response['NewStatus'])
            && $response['NewStatus'] == $newStatus
        ) {
            return true;
        }
        
        return false;
    }
    
    
    /**
     * @param string $invoiceNum
     * @param string $shipmentID
     * @param string $tracking
     * @param string $shipmentDate
     * @param string $callBackUrl
     *
     * @return bool
     */
    public function updateOrderShipment(
        $invoiceNum,
        $shipmentID,
        $tracking,
        $shipmentDate,
        $callBackUrl = ''
    ) {
        /** @noinspection PhpUndefinedMethodInspection */
        $response = $this->soapClient->updateOrderShipment(array(
            'storeUrl'     => $this->threeDCartStoreUrl,
            'userKey'      => $this->threeDCartApiKey,
            'invoiceNum'   => $invoiceNum,
            'shipmentID'   => $shipmentID,
            'tracking'     => $tracking,
            'shipmentDate' => $shipmentDate,
            'callBackURL'  => $callBackUrl
        ));
        
        $response = $this->responseHandler->processXMLToArray($response->updateOrderShipmentResult, null);
        
        if (isset($response['result']) && $response['result'] == 'OK') {
            return true;
        }
        
        return false;
    }
    
    /**
     * @param ResponseHandlerInterface $responseHandler
     */
    public function setResponseHandler(ResponseHandlerInterface $responseHandler)
    {
        $this->responseHandler = $responseHandler;
    }
    
    /**
     * @param \SoapClient $soapClient
     */
    public function setSoapClient($soapClient)
    {
        $this->soapClient = $soapClient;
    }
}
