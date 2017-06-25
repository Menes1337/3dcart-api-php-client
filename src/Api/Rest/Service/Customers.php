<?php

namespace ThreeDCart\Api\Rest\Service;

use ThreeDCart\Api\Rest\Filter\CustomerInterface;
use ThreeDCart\Api\Rest\Request\ApiPathAppendix;
use ThreeDCart\Api\Rest\Request\HttpMethod;
use ThreeDCart\Api\Rest\Request\HttpParameter;
use ThreeDCart\Api\Rest\Request\HttpParameterList;
use ThreeDCart\Api\Rest\Resource\Customer;
use ThreeDCart\Api\Rest\Select\SelectInterface;
use ThreeDCart\Api\Rest\Sort\SortInterface;
use ThreeDCart\Primitive\StringValueObject;

/**
 * Class Customers
 *
 * @package ThreeDCart\Api\Rest\Request\Service
 */
class Customers extends AbstractService implements CustomersInterface
{
    public function getCustomers(
        SelectInterface $selectList = null,
        CustomerInterface $customerFilterList = null,
        SortInterface $sortOrderList = null
    ) {
        $requestParameterList =
            !is_null($customerFilterList) ? $customerFilterList->getHttpParameterList() : new HttpParameterList();
        
        if ($sortOrderList !== null && !$sortOrderList->isEmpty()->getBoolValue()) {
            $requestParameterList->addParameter(
                new HttpParameter(
                    new StringValueObject('$orderby'),
                    $sortOrderList->getQueryString()
                )
            );
        }
        
        if ($selectList !== null && !$selectList->isEmpty()->getBoolValue()) {
            $requestParameterList->addParameter(
                new HttpParameter(
                    new StringValueObject('$select'),
                    $selectList->getQueryString()
                )
            );
        }
        
        $rawResponse = $this->requestClient->send(
            new HttpMethod(HttpMethod::HTTP_METHOD_GET),
            new ApiPathAppendix(''),
            $requestParameterList,
            new HttpParameterList()
        );
        
        return Customer::fromList(json_decode($rawResponse->getStringValue(), true));
    }
}
