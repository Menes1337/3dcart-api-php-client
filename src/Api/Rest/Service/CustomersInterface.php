<?php

namespace ThreeDCart\Api\Rest\Service;

use ThreeDCart\Api\Rest\Filter\CustomerInterface;
use ThreeDCart\Api\Rest\Request\RequestException;
use ThreeDCart\Api\Rest\Resource\Customer;
use ThreeDCart\Api\Rest\Select\SelectInterface;
use ThreeDCart\Api\Rest\Sort\SortInterface;
use ThreeDCart\Primitive\StringValueObject;

interface CustomersInterface
{
    /**
     * @param SelectInterface|null   $selectList
     * @param CustomerInterface|null $customerFilterList
     * @param SortInterface|null     $sortOrderList
     *
     * @return Customer[]
     *
     * @throws RequestException
     */
    public function getCustomers(
        SelectInterface $selectList = null,
        CustomerInterface $customerFilterList = null,
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
