<?php

namespace ThreeDCart\Api\Rest\Service;

use ThreeDCart\Api\Rest\Filter\CustomerInterface;
use ThreeDCart\Api\Rest\Select\SelectInterface;
use ThreeDCart\Api\Rest\Sort\SortInterface;
use ThreeDCart\Primitive\StringValueObject;

interface CustomersInterface
{
    /**
     * @param SelectInterface        $selectList
     * @param CustomerInterface|null $customerFilterList
     * @param SortInterface          $sortOrderList
     *
     * @return StringValueObject
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
