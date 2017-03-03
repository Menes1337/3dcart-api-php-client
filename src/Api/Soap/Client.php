<?php

namespace ThreeDCart\Api\Soap;

use ThreeDCart\Api\Soap\Exception\ApiErrorException;
use ThreeDCart\Api\Soap\Exception\MalFormedApiResponseException;
use ThreeDCart\Api\Soap\Exception\ParseException;
use ThreeDCart\Api\Soap\Exception\ResponseBodyEmptyException;
use ThreeDCart\Api\Soap\Client\Request\MethodsInterface;
use ThreeDCart\Api\Soap\Resource\Customer\Address;
use ThreeDCart\Api\Soap\Resource\Customer\Customer;
use ThreeDCart\Api\Soap\Resource\Customer\LoginToken;
use ThreeDCart\Api\Soap\Resource\Order\Order;
use ThreeDCart\Api\Soap\Resource\Order\Status;
use ThreeDCart\Api\Soap\Resource\Product\Product;
use ThreeDCart\Api\Soap\Resource\Product\ProductInventory;
use ThreeDCart\Api\Soap\Resource\ResourceParserInterface;
use ThreeDCart\Api\Soap\Resource\SoapResource;

class Client
{
    /** @var MethodsInterface */
    private $soapClient;
    /** @var ResponseHandlerInterface */
    private $responseHandler;
    /** @var ResourceParserInterface */
    private $resourceParser;
    
    /**
     * @param MethodsInterface         $soapClient
     * @param ResponseHandlerInterface $responseHandler
     * @param ResourceParserInterface  $resourceParser
     */
    public function __construct(
        MethodsInterface $soapClient,
        ResponseHandlerInterface $responseHandler,
        ResourceParserInterface $resourceParser
    ) {
        $this->soapClient      = $soapClient;
        $this->responseHandler = $responseHandler;
        $this->resourceParser  = $resourceParser;
    }
    
    /**
     * @param int    $batchSize
     * @param int    $startNum
     * @param string $productId
     * @param string $callBackUrl
     *
     * @return Product[]
     *
     * @throws MalFormedApiResponseException
     * @throws ApiErrorException
     * @throws ResponseBodyEmptyException
     * @throws ParseException
     */
    public function getProducts($batchSize = 100, $startNum = 1, $productId = '', $callBackUrl = '')
    {
        $soapResponse = $this->soapClient->getProduct($batchSize, $startNum, $productId, $callBackUrl);
        
        /** @var Product[] $products */
        $products = $this->getResources(
            Product::class,
            $this->responseHandler->convertXML($soapResponse->getProductResult, 'Product')
        );
        
        return $products;
    }
    
    /**
     * @param int    $batchSize       Number of records to pull. Range: 1 to 100.
     * @param int    $startNum        Position to start the search. Range: 1 to x
     * @param string $customersFilter Comma delimited string with zero or more search parameters. Allowed parameters: firstname, lastname, email, countrycode, statecode, city, phone. i.e.: firstname=John,email=john@email.com, countrycode=US,statecode=FL,city=Margate
     * @param string $callBackUrl
     *
     * @return Customer[]
     */
    public function getCustomers($batchSize = 100, $startNum = 1, $customersFilter = '', $callBackUrl = '')
    {
        $soapResponse = $this->soapClient->getCustomers($batchSize, $startNum, $customersFilter, $callBackUrl);
        
        /** @var Customer[] $customers */
        $customers = $this->getResources(
            Customer::class,
            $this->responseHandler->convertXML($soapResponse->getCustomerResult, 'Customer')
        );
        
        return $customers;
    }
    
    /**
     * @param int    $invoiceNum
     * @param string $callBackUrl
     *
     * @return Status
     */
    public function getOrderStatus($invoiceNum, $callBackUrl = '')
    {
        $soapResponse = $this->soapClient->getOrderStatus($invoiceNum, $callBackUrl);
        
        /** @var Status $orderStatus */
        $orderStatus = $this->resourceParser->getResource(
            Status::class,
            $this->responseHandler->convertXML($soapResponse->getOrderStatusResult)
        );
        
        return $orderStatus;
    }
    
    /**
     * @param string $callBackUrl
     *
     * @return int
     */
    public function getProductCount($callBackUrl = '')
    {
        $soapResponse = $this->soapClient->getProductCount($callBackUrl);
        
        return (int)$this->responseHandler->convertXML($soapResponse->getProductCountResult, 'ProductQuantity');
    }
    
    /**
     * @param int    $productId
     * @param string $callBackUrl
     *
     * @return ProductInventory
     */
    public function getProductInventory($productId, $callBackUrl = '')
    {
        $soapResponse = $this->soapClient->getProductInventory($productId, $callBackUrl);
        
        /** @var ProductInventory $productInventory */
        $productInventory = $this->resourceParser->getResource(
            ProductInventory::class,
            $this->responseHandler->convertXML($soapResponse->getProductInventoryResult)
        );
        
        return $productInventory;
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
        $response = $this->soapClient->getCustomerLoginToken($customerEmail, $timeToLive, $callBackUrl);
        
        /** @var LoginToken $loginToken */
        $loginToken = $this->resourceParser->getResource(
            LoginToken::class,
            $this->responseHandler->convertXML($response->getCustomerLoginTokenResult)
        );
        
        return $loginToken;
    }
    
    /**
     * @param string $callBackUrl
     *
     * @return int
     */
    public function getCustomerCount($callBackUrl = '')
    {
        $response = $this->soapClient->getCustomerCount($callBackUrl);
        
        return (int)$this->responseHandler->convertXML($response->getCustomerCountResult, 'CustomerCount');
    }
    
    /**
     * @param bool   $startFrom
     * @param string $invoiceNum
     * @param string $status
     * @param string $dateFrom
     * @param string $dateTo
     * @param string $callBackUrl
     *
     * @return int
     */
    public function getOrderCount(
        $startFrom = true,
        $invoiceNum = '',
        $status = '',
        $dateFrom = '',
        $dateTo = '',
        $callBackUrl = ''
    ) {
        $response =
            $this->soapClient->getOrderCount($startFrom, $invoiceNum, $status, $dateFrom, $dateTo, $callBackUrl);
        
        return (int)$this->responseHandler->convertXML($response->getOrderCountResult, 'Quantity');
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
     * @return Order[]
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
        $soapResponse =
            $this->soapClient->getOrders($batchSize, $startNum, $startFrom, $invoiceNum, $status, $dateFrom, $dateTo,
                $callBackUrl);
        
        /** @var Order[] $orders */
        $orders = $this->getResources(
            Order::class,
            $this->responseHandler->convertXML($soapResponse->getOrderResult, 'Order')
        );
        
        return $orders;
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
        $soapResponse = $this->soapClient->updateProductInventory($productId, $quantity, $replaceStock, $callBackUrl);
        
        /** @var array $convertedResponse */
        $convertedResponse = $this->responseHandler->convertXML($soapResponse->updateProductInventoryResult);
        
        return $this->checkProductIdsQuantity($productId, $quantity, $convertedResponse);
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
        $soapResponse = $this->soapClient->updateOrderStatus($invoiceNum, $newStatus, $callBackUrl);
        
        /** @var array $convertedResponse */
        $convertedResponse = $this->responseHandler->convertXML($soapResponse->updateOrderStatusResult);
        
        return $this->checkInvoiceNumsNewStatus($invoiceNum, $newStatus, $convertedResponse);
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
        $soapResponse =
            $this->soapClient->updateOrderShipment($invoiceNum, $shipmentID, $tracking, $shipmentDate, $callBackUrl);
        
        /** @var array $convertedResponse */
        $convertedResponse = $this->responseHandler->convertXML($soapResponse->updateOrderShipmentResult);
        
        return $this->isResultOk($convertedResponse);
    }
    
    /**
     * @param Customer $customer
     * @param array    $customerDataFieldList pass a list of parameter to define which fields should be generated.
     *                                        Use the Customer::EDIT_CUSTOMER_* constants
     * @param string   $callBackUrl
     *
     * @return bool
     */
    public function updateCustomer(Customer $customer, array $customerDataFieldList, $callBackUrl = '')
    {
        if (count($customerDataFieldList) == 1
            && current($customerDataFieldList) == Customer::EDIT_CUSTOMER_ALT_CONTACTID
        ) {
            $customerDataFieldList[] = Customer::EDIT_CUSTOMER_CONTACTID;
        }
        
        $soapResponse = $this->editCustomer($customer, $customerDataFieldList, Customer::UPDATE, $callBackUrl);
        
        /** @var array $convertedResponse */
        $convertedResponse = $this->responseHandler->convertXML($soapResponse->editCustomerResult);
        
        return $this->isResultOk($convertedResponse);
    }
    
    /**
     * @param Customer $customer
     * @param string   $callBackUrl
     *
     * @return bool
     */
    public function insertCustomer(Customer $customer, $callBackUrl = '')
    {
        $insertFieldList = $this->getCustomerInsertFieldList($customer);
        
        $generatedCustomerData = $customer->getCustomerData(
            array_unique(
                array_keys(
                    $insertFieldList
                )
            )
        );
        
        $this->insertCustomerCheckRequiredFields($generatedCustomerData);
        
        $soapResponse = $this->soapClient->editCustomer(
            $this->convertCustomerData($generatedCustomerData),
            Customer::INSERT,
            $callBackUrl);
        
        /** @var array $convertedResponse */
        $convertedResponse = $this->responseHandler->convertXML($soapResponse->editCustomerResult);
        
        $isResultOk = $this->isResultOk($convertedResponse);
        
        if ($isResultOk && isset($convertedResponse['contactid'])) {
            $customer->setCustomerID($convertedResponse['contactid']);
        }
        
        return $isResultOk;
    }
    
    /**
     * @param Customer $customer
     * @param string   $callBackUrl
     *
     * @return bool
     */
    public function deleteCustomer(Customer $customer, $callBackUrl = '')
    {
        $soapResponse = $this->editCustomer($customer, array(), Customer::DELETE, $callBackUrl);
        
        /** @var array $convertedResponse */
        $convertedResponse = $this->responseHandler->convertXML($soapResponse->editCustomerResult);
        
        return $this->isResultOk($convertedResponse);
    }
    
    /**
     * @param Customer $customer
     * @param array    $customerDataFieldList pass a list of parameter to define which fields should be updated.
     *                                        Use the Customer::EDIT_CUSTOMER_* constants
     * @param string   $action
     * @param string   $callBackUrl
     *
     * @return \stdClass
     */
    private function editCustomer(Customer $customer, array $customerDataFieldList, $action, $callBackUrl = '')
    {
        $customerDataFieldList[] = $this->getCustomerIdentifier($customer);
        
        return $this->soapClient->editCustomer(
            $this->convertCustomerData(
                $customer->getCustomerData(
                    array_unique($customerDataFieldList)
                )
            ),
            $action,
            $callBackUrl);
    }
    
    /**
     * @param ResponseHandlerInterface $responseHandler
     */
    public function setResponseHandler(ResponseHandlerInterface $responseHandler)
    {
        $this->responseHandler = $responseHandler;
    }
    
    /**
     * @param string $className
     * @param array  $objectData
     *
     * @return SoapResource[]
     */
    protected function getResources($className, array $objectData)
    {
        if (isset($objectData[0])) {
            return $this->resourceParser->getResources($className, $objectData);
        }
        
        return array($this->resourceParser->getResource($className, $objectData));
    }
    
    /**
     * @param int   $productId
     * @param int   $quantity
     * @param array $response
     *
     * @return bool
     */
    protected function checkProductIdsQuantity($productId, $quantity, array $response)
    {
        return isset($response['ProductID']) && $response['ProductID'] == $productId
            && isset($response['NewInventory'])
            && $response['NewInventory'] == $quantity;
    }
    
    /**
     * @param string $invoiceNum
     * @param string $newStatus
     * @param array  $response
     *
     * @return bool
     */
    protected function checkInvoiceNumsNewStatus($invoiceNum, $newStatus, array $response)
    {
        return isset($response['InvoiceNum']) && $response['InvoiceNum'] == $invoiceNum
            && isset($response['NewStatus'])
            && $response['NewStatus'] == $newStatus;
    }
    
    /**
     * @param array $response
     *
     * @return bool
     */
    protected function isResultOk(array $response)
    {
        return isset($response['result']) && $response['result'] == 'OK';
    }
    
    /**
     * @param Customer $customer
     *
     * @return string
     */
    protected function getCustomerIdentifier(Customer $customer)
    {
        $altCustomerId = $customer->getUserID();
        
        return !empty($altCustomerId) ? Customer::EDIT_CUSTOMER_ALT_CONTACTID : Customer::EDIT_CUSTOMER_CONTACTID;
    }
    
    /**
     * @param array $generatedCustomerData
     */
    protected function insertCustomerCheckRequiredFields(array $generatedCustomerData)
    {
        $requiredFields = array('billing_firstname', 'billing_lastname', 'email', 'pass');
        foreach ($requiredFields as $requiredField) {
            if (!isset($generatedCustomerData[$requiredField])) {
                throw new \InvalidArgumentException(
                    'the field: ' . $requiredField . ' is required when inserting a new customer!'
                );
            }
        }
    }
    
    /**
     * @param array $customerData
     *
     * @return string
     */
    protected function convertCustomerData(array $customerData)
    {
        $temporaryCustomerData = array();
        foreach ($customerData as $key => $value) {
            if ($value === null) {
                continue;
            }
            $temporaryCustomerData[] = $key . '===' . $value;
        }
        
        return implode('|||', $temporaryCustomerData);
    }
    
    /**
     * @param Customer $customer
     *
     * @return array
     */
    protected function getCustomerInsertFieldList(Customer $customer)
    {
        $insertFieldList = Customer::$editCustomerMapping;
        
        if ($customer->getBillingAddress()) {
            $insertFieldList = array_merge($insertFieldList, Address::$editCustomerMappingBilling);
        }
        
        if ($customer->getShippingAddress()) {
            $insertFieldList = array_merge($insertFieldList, Address::$editCustomerMappingShipping);
        }
        
        return $insertFieldList;
    }
    
    /**
     * @param MethodsInterface $soapClient
     */
    public function setSoapClient(MethodsInterface $soapClient)
    {
        $this->soapClient = $soapClient;
    }
}
