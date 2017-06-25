<?php

namespace ThreeDCart\Api\Rest\Service;

use ThreeDCart\Api\Rest\Filter\FilterInterface;
use ThreeDCart\Api\Rest\Resource\Customer;
use ThreeDCart\Api\Rest\Select\SelectListInterface;
use ThreeDCart\Api\Rest\Sort\SortInterface;

/**
 * Class Customers
 *
 * @package ThreeDCart\Api\Rest\Request\Service
 */
class Customers extends AbstractService implements CustomersInterface
{
    public function getCustomers(
        SelectListInterface $selectList = null,
        FilterInterface $filterList = null,
        SortInterface $sortOrderList = null
    ) {
        $rawResponse = $this->sendRequest($selectList, $filterList, $sortOrderList);
        
        return Customer::fromList(json_decode($rawResponse->getStringValue(), true));
    }
}
