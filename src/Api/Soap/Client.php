<?php

namespace ThreeDCart\Api\Soap;

use ThreeDCart\Api\Soap\Request\ClientInterface;
use ThreeDCart\Api\Soap\Request\MalFormedApiResponseException;
use ThreeDCart\Api\Soap\Request\ResponseHandlerInterface;
use ThreeDCart\Api\Soap\Request\ResponseInvalidException;
use ThreeDCart\Api\Soap\Resource\Customer\Address;
use ThreeDCart\Api\Soap\Resource\Customer\Customer;
use ThreeDCart\Api\Soap\Resource\Customer\LoginToken;
use ThreeDCart\Api\Soap\Resource\Order\Order;
use ThreeDCart\Api\Soap\Resource\Order\Status;
use ThreeDCart\Api\Soap\Resource\Product\Product;
use ThreeDCart\Api\Soap\Resource\Product\ProductInventory;
use ThreeDCart\Api\Soap\Resource\ResourceParserInterface;
use ThreeDCart\Api\Soap\Resource\SoapResource;
use ThreeDCart\Primitive\ArrayValueObject;
use ThreeDCart\Api\Soap\Response\Xml;
use ThreeDCart\Primitive\IntegerValueObject;
use ThreeDCart\Primitive\StringValueObject;

/**
 * Class Client
 *
 * @package ThreeDCart\Api\Soap
 */
class Client
{
    const THREEDCART_SOAP_API_URL = 'http://api.3dcart.com/cart.asmx';
    
    CONST XML_TAG_PRODUCT             = 'Product';
    CONST XML_TAG_CUSTOMER            = 'Customer';
    CONST XML_TAG_PRODUCT_QUANTITY    = 'ProductQuantity';
    CONST XML_TAG_CUSTOMER_COUNT      = 'CustomerCount';
    CONST XML_TAG_ORDER_QUANTITY      = 'Quantity';
    CONST XML_TAG_ORDER               = 'Order';
    CONST XML_TAG_CUSTOMER_CONTACT_ID = 'contactid';
    CONST XML_TAG_Product_ID          = 'ProductID';
    CONST XML_TAG_NEW_INVENTORY       = 'NewInventory';
    CONST XML_TAG_INVOICE_NUM         = 'InvoiceNum';
    CONST XML_TAG_NEW_STATUS          = 'NewStatus';
    CONST XML_TAG_RESULT              = 'result';
    CONST XML_TAG_RESULT_OK           = 'OK';
    
    /** @var ClientInterface */
    private $soapClient;
    /** @var ResponseHandlerInterface */
    private $responseHandler;
    /** @var ResourceParserInterface */
    private $resourceParser;
    
    /**
     * @param ClientInterface          $soapClient
     * @param ResponseHandlerInterface $responseHandler
     * @param ResourceParserInterface  $resourceParser
     */
    public function __construct(
        ClientInterface $soapClient,
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
     * @throws ResponseInvalidException
     */
    public function getProducts($batchSize = 100, $startNum = 1, $productId = '', $callBackUrl = '')
    {
        $xmlResponse = $this->soapClient->getProduct($batchSize, $startNum, $productId, $callBackUrl);
        
        /** @var Product[] $products */
        $products = $this->getResources(
            $xmlResponse,
            new StringValueObject(Product::class),
            new StringValueObject(self::XML_TAG_PRODUCT)
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
     *
     * @throws ResponseInvalidException
     */
    public function getCustomers($batchSize = 100, $startNum = 1, $customersFilter = '', $callBackUrl = '')
    {
        $xmlResponse = $this->soapClient->getCustomers($batchSize, $startNum, $customersFilter, $callBackUrl);
        
        /** @var Customer[] $customers */
        $customers = $this->getResources(
            $xmlResponse,
            new StringValueObject(Customer::class),
            new StringValueObject(self::XML_TAG_CUSTOMER)
        );
        
        return $customers;
    }
    
    /**
     * @param int    $invoiceNum
     * @param string $callBackUrl
     *
     * @return Status
     *
     * @throws ResponseInvalidException
     */
    public function getOrderStatus($invoiceNum, $callBackUrl = '')
    {
        $xmlResponse = $this->soapClient->getOrderStatus($invoiceNum, $callBackUrl);
        
        /** @var Status $orderStatus */
        $orderStatus = $this->getResource($xmlResponse, new StringValueObject(Status::class));
        
        return $orderStatus;
    }
    
    /**
     * @param string $callBackUrl
     *
     * @return IntegerValueObject
     *
     * @throws ResponseInvalidException
     */
    public function getProductCount($callBackUrl = '')
    {
        $xmlResponse = $this->soapClient->getProductCount($callBackUrl);
        
        return $this->getIntegerValueObject($xmlResponse, new StringValueObject(self::XML_TAG_PRODUCT_QUANTITY));
    }
    
    /**
     * @param int    $productId
     * @param string $callBackUrl
     *
     * @return ProductInventory
     *
     * @throws ResponseInvalidException
     */
    public function getProductInventory($productId, $callBackUrl = '')
    {
        $xmlResponse = $this->soapClient->getProductInventory($productId, $callBackUrl);
        
        /** @var ProductInventory $productInventory */
        $productInventory = $this->getResource($xmlResponse, new StringValueObject(ProductInventory::class));
        
        return $productInventory;
    }
    
    /**
     * @param string $customerEmail
     * @param int    $timeToLive
     * @param string $callBackUrl
     *
     * @return LoginToken
     *
     * @throws ResponseInvalidException
     */
    public function getCustomerLoginToken($customerEmail, $timeToLive, $callBackUrl = '')
    {
        $xmlResponse = $this->soapClient->getCustomerLoginToken($customerEmail, $timeToLive, $callBackUrl);
        
        /** @var LoginToken $loginToken */
        $loginToken = $this->getResource($xmlResponse, new StringValueObject(LoginToken::class));
        
        return $loginToken;
    }
    
    /**
     * @param string $callBackUrl
     *
     * @return IntegerValueObject
     *
     * @throws ResponseInvalidException
     */
    public function getCustomerCount($callBackUrl = '')
    {
        $xmlResponse = $this->soapClient->getCustomerCount($callBackUrl);
        
        return $this->getIntegerValueObject($xmlResponse, new StringValueObject(self::XML_TAG_CUSTOMER_COUNT));
    }
    
    /**
     * @param bool   $startFrom
     * @param string $invoiceNum
     * @param string $status
     * @param string $dateFrom
     * @param string $dateTo
     * @param string $callBackUrl
     *
     * @return IntegerValueObject
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
    ) {
        $xmlResponse =
            $this->soapClient->getOrderCount($startFrom, $invoiceNum, $status, $dateFrom, $dateTo, $callBackUrl);
        
        return $this->getIntegerValueObject($xmlResponse, new StringValueObject(self::XML_TAG_ORDER_QUANTITY));
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
    ) {
        $xmlResponse = $this->soapClient->getOrders(
            $batchSize,
            $startNum,
            $startFrom,
            $invoiceNum,
            $status,
            $dateFrom,
            $dateTo,
            $callBackUrl
        );
        
        /** @var Order[] $orders */
        $orders = $this->getResources(
            $xmlResponse,
            new StringValueObject(Order::class),
            new StringValueObject(self::XML_TAG_ORDER)
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
     *
     * @throws ResponseInvalidException
     */
    public function updateProductInventory(
        $productId,
        $quantity,
        $replaceStock = true,
        $callBackUrl = ''
    ) {
        $xmlResponse = $this->soapClient->updateProductInventory($productId, $quantity, $replaceStock, $callBackUrl);
        
        return $this->checkProductIdsQuantity(
            new IntegerValueObject($productId),
            new IntegerValueObject($quantity),
            $this->getArrayValueObject($xmlResponse)
        );
    }
    
    /**
     * @param string $invoiceNum
     * @param string $newStatus
     * @param string $callBackUrl
     *
     * @return bool
     *
     * @throws ResponseInvalidException
     */
    public function updateOrderStatus(
        $invoiceNum,
        $newStatus,
        $callBackUrl = ''
    ) {
        $xmlResponse = $this->soapClient->updateOrderStatus($invoiceNum, $newStatus, $callBackUrl);
        
        return $this->checkInvoiceNumsNewStatus(
            new StringValueObject($invoiceNum),
            new StringValueObject($newStatus),
            $this->getArrayValueObject($xmlResponse)
        );
    }
    
    /**
     * @param string $invoiceNum
     * @param string $shipmentID
     * @param string $tracking
     * @param string $shipmentDate
     * @param string $callBackUrl
     *
     * @return bool
     *
     * @throws ResponseInvalidException
     */
    public function updateOrderShipment(
        $invoiceNum,
        $shipmentID,
        $tracking,
        $shipmentDate,
        $callBackUrl = ''
    ) {
        $xmlResponse =
            $this->soapClient->updateOrderShipment($invoiceNum, $shipmentID, $tracking, $shipmentDate, $callBackUrl);
        
        return $this->isResultOk($this->getArrayValueObject($xmlResponse));
    }
    
    /**
     * @param Customer $customer
     * @param array    $customerDataFieldList pass a list of parameter to define which fields should be generated.
     *                                        Use the Customer::EDIT_CUSTOMER_* constants
     * @param string   $callBackUrl
     *
     * @return bool
     *
     * @throws ResponseInvalidException
     */
    public function updateCustomer(Customer $customer, array $customerDataFieldList, $callBackUrl = '')
    {
        if (count($customerDataFieldList) == 1
            && current($customerDataFieldList) == Customer::EDIT_CUSTOMER_ALT_CONTACTID
        ) {
            $customerDataFieldList[] = Customer::EDIT_CUSTOMER_CONTACTID;
        }
        
        $xmlResponse = $this->editCustomer($customer, $customerDataFieldList, Customer::UPDATE, $callBackUrl);
        
        return $this->isResultOk($this->getArrayValueObject($xmlResponse));
    }
    
    /**
     * @param Customer $customer
     * @param string   $callBackUrl
     *
     * @return bool
     *
     * @throws ResponseInvalidException
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
        
        $xmlResponse = $this->soapClient->editCustomer(
            $this->convertCustomerData($generatedCustomerData),
            Customer::INSERT,
            $callBackUrl);
        
        $arrayResponse = $this->getArrayValueObject($xmlResponse);
        $isResultOk    = $this->isResultOk($arrayResponse);
        
        if ($isResultOk && $arrayResponse->issetKey(new StringValueObject(self::XML_TAG_CUSTOMER_CONTACT_ID))) {
            $customer->setCustomerID($arrayResponse->getIntegerValueObject(new StringValueObject(self::XML_TAG_CUSTOMER_CONTACT_ID))
                                                   ->getValue());
        }
        
        return $isResultOk;
    }
    
    /**
     * @param Customer $customer
     * @param string   $callBackUrl
     *
     * @return bool
     *
     * @throws ResponseInvalidException
     */
    public function deleteCustomer(Customer $customer, $callBackUrl = '')
    {
        $xmlResponse = $this->editCustomer($customer, array(), Customer::DELETE, $callBackUrl);
        
        return $this->isResultOk($this->getArrayValueObject($xmlResponse));
    }
    
    /**
     * @param Customer $customer
     * @param array    $customerDataFieldList pass a list of parameter to define which fields should be updated.
     *                                        Use the Customer::EDIT_CUSTOMER_* constants
     * @param string   $action
     * @param string   $callBackUrl
     *
     * @return Xml
     *
     * @throws ResponseInvalidException
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
     * @param Xml               $xml
     * @param StringValueObject $className
     * @param StringValueObject $tagName
     *
     * @return SoapResource[]
     *
     * @throws ResponseInvalidException
     */
    protected function getResources(Xml $xml, StringValueObject $className, StringValueObject $tagName)
    {
        $objectData = $this->responseHandler->convertToArray($xml);
        $this->responseHandler->handleApiErrors($xml, $objectData);
        
        $objectData = $this->extractSpecificXmlTagAsArray($tagName, $objectData);
        
        if ($objectData->issetIndex(new IntegerValueObject(0))) {
            return $this->resourceParser->getResources($className, $objectData);
        }
        
        return array($this->resourceParser->getResource($className, $objectData));
    }
    
    /**
     * @param Xml $xml
     *
     * @return ArrayValueObject
     */
    protected function getArrayValueObject(Xml $xml)
    {
        $objectData = $this->responseHandler->convertToArray($xml);
        $this->responseHandler->handleApiErrors($xml, $objectData);
        
        return $objectData;
    }
    
    /**
     * @param Xml               $xml
     * @param StringValueObject $className
     *
     * @return SoapResource
     */
    protected function getResource(Xml $xml, StringValueObject $className)
    {
        $objectData = $this->responseHandler->convertToArray($xml);
        $this->responseHandler->handleApiErrors($xml, $objectData);
        
        return $this->resourceParser->getResource($className, $objectData);
    }
    
    /**
     * @param Xml               $xml
     * @param StringValueObject $tagName
     *
     * @return IntegerValueObject
     */
    protected function getIntegerValueObject(Xml $xml, StringValueObject $tagName)
    {
        $objectData = $this->responseHandler->convertToArray($xml);
        $this->responseHandler->handleApiErrors($xml, $objectData);
        
        return new IntegerValueObject((int)$this->extractSpecificXmlTagAsString(
            $tagName,
            $objectData
        )->getValue());
    }
    
    /**
     * @param IntegerValueObject $productId
     * @param IntegerValueObject $quantity
     * @param ArrayValueObject   $response
     *
     * @return bool
     */
    protected function checkProductIdsQuantity(
        IntegerValueObject $productId,
        IntegerValueObject $quantity,
        ArrayValueObject $response
    ) {
        return
            $response->issetKey(new StringValueObject(self::XML_TAG_Product_ID))
            && $response->getIntegerValueObject(new StringValueObject(self::XML_TAG_Product_ID))->getValue()
            === $productId->getValue()
            && $response->issetKey(new StringValueObject(self::XML_TAG_NEW_INVENTORY))
            && $response->getIntegerValueObject(new StringValueObject(self::XML_TAG_NEW_INVENTORY))->getValue()
            === $quantity->getValue();
    }
    
    /**
     * @param StringValueObject $invoiceNum
     * @param StringValueObject $newStatus
     * @param ArrayValueObject  $response
     *
     * @return bool
     */
    protected function checkInvoiceNumsNewStatus(
        StringValueObject $invoiceNum,
        StringValueObject $newStatus,
        ArrayValueObject $response
    ) {
        return $response->issetKey(new StringValueObject(self::XML_TAG_INVOICE_NUM))
            && $response->getStringValueObject(new StringValueObject(self::XML_TAG_INVOICE_NUM))->getValue()
            === $invoiceNum->getValue()
            && $response->issetKey(new StringValueObject(self::XML_TAG_NEW_STATUS))
            && $response->getStringValueObject(new StringValueObject(self::XML_TAG_NEW_STATUS))->getValue()
            === $newStatus->getValue();
    }
    
    /**
     * @param ArrayValueObject $response
     *
     * @return bool
     */
    protected function isResultOk(ArrayValueObject $response)
    {
        return $response->issetKey(new StringValueObject(self::XML_TAG_RESULT))
            && $response->getStringValueObject(new StringValueObject(self::XML_TAG_RESULT))->getValue()
            == self::XML_TAG_RESULT_OK;
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
     * @param ClientInterface $soapClient
     */
    public function setSoapClient(ClientInterface $soapClient)
    {
        $this->soapClient = $soapClient;
    }
    
    /**
     * @param StringValueObject $responseXmlTag
     * @param ArrayValueObject  $apiResponse
     *
     * @return ArrayValueObject
     *
     * @throws MalFormedApiResponseException
     */
    protected function extractSpecificXmlTagAsArray(StringValueObject $responseXmlTag, ArrayValueObject $apiResponse)
    {
        $arrResponse = $apiResponse->getValue();
        if (!isset($arrResponse[$responseXmlTag->getValue()])) {
            throw new MalFormedApiResponseException('xml tag ' . $responseXmlTag->getValue() . ' is missing');
        }
        
        return new ArrayValueObject($arrResponse[$responseXmlTag->getValue()]);
    }
    
    /**
     * @param StringValueObject $responseXmlTag
     * @param ArrayValueObject  $apiResponse
     *
     * @return StringValueObject
     *
     * @throws MalFormedApiResponseException
     */
    protected function extractSpecificXmlTagAsString(StringValueObject $responseXmlTag, ArrayValueObject $apiResponse)
    {
        $arrResponse = $apiResponse->getValue();
        if (!isset($arrResponse[$responseXmlTag->getValue()])) {
            throw new MalFormedApiResponseException('xml tag ' . $responseXmlTag->getValue() . ' is missing');
        }
        
        return new StringValueObject($arrResponse[$responseXmlTag->getValue()]);
    }
}
