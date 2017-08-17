<?php

namespace ThreeDCart\Api\Rest\Service;

use ThreeDCart\Api\Rest\Filter\FilterListInterface;
use ThreeDCart\Api\Rest\Request\RequestException;
use ThreeDCart\Api\Rest\Resource\Customer;
use ThreeDCart\Api\Rest\Select\SelectListInterface;
use ThreeDCart\Api\Rest\Sort\SortInterface;

interface CustomersInterface
{
    /**
     * @param SelectListInterface|null $selectList
     * @param FilterListInterface|null $filterList
     * @param SortInterface|null       $sortOrderList
     *
     * @return Customer[]
     *
     * @throws RequestException
     */
    public function getCustomers(
        SelectListInterface $selectList = null,
        FilterListInterface $filterList = null,
        SortInterface $sortOrderList = null
    );
    
    //    public function getCustomer(CustomerId $customerId);
//
//    public function addCustomer(Customer $customer);
//
//    public function updateCustomer(Customer $customer);
//
//    public function updateCustomers(CustomersList $customer);
//
//    public function deleteCustomer(Customer $customer);
}
