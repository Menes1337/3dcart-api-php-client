<?php

namespace ThreeDCart\Api\Soap;

use ThreeDCart\Api\Soap\Resources\Customer\Customer;
use ThreeDCart\Api\Soap\Resources\Order\OrderStatus;
use ThreeDCart\Api\Soap\Resources\Product\Product;
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
    public function getProduct($batchSize = 100, $startNum = 1, $productId = '', $callBackUrl = '')
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
    public function getCustomer($batchSize = 100, $startNum = 1, $customersFilter = '', $callBackUrl = '')
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
     * @return OrderStatus
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
            OrderStatus::class,
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
        $callBackUrl = '',
        $startFrom = true,
        $invoiceNum = '',
        $status = '',
        $dateFrom = '',
        $dateTo = ''
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
