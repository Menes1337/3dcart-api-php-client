<?php

namespace ThreeDCart\Api\Rest\Service;

use ThreeDCart\Api\Rest\Filter\FilterInterface;
use ThreeDCart\Api\Rest\Resource\Category;
use ThreeDCart\Api\Rest\Select\SelectListInterface;
use ThreeDCart\Api\Rest\Sort\SortInterface;

/**
 * @package ThreeDCart\Api\Rest\Request\Service
 */
class Categories extends AbstractService implements CategoriesInterface
{
    public function getCategories(
        SelectListInterface $selectList = null,
        FilterInterface $filterList = null,
        SortInterface $sortOrderList = null
    ) {
        $rawResponse = $this->sendRequest($selectList, $filterList, $sortOrderList);
        
        return Category::fromList(json_decode($rawResponse->getStringValue(), true));
    }

//    public function getCustomer(CustomerId $customerId)
//    {
//        return $this->requestHandler->request(
//            new HttpMethod(HttpMethod::HTTP_METHOD_GET),
//            new ApiPathAppendix('')
//        );
//    }
//
//    public function addCustomer(Customer $customer)
//    {
//    }
//
//    public function updateCustomer(Customer $customer)
//    {
//    }
//
//    public function updateCustomers(CustomersList $customer)
//    {
//    }
//
//    public function deleteCustomer(Customer $customer)
//    {
//    }
    
}
