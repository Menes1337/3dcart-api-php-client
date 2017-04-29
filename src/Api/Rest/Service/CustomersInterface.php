<?php

namespace ThreeDCart\Api\Rest\Service;

use ThreeDCart\Api\Rest\Filter\CustomerFilterInterface;
use ThreeDCart\Primitive\StringValueObject;

interface CustomersInterface
{
    /**
     * @param CustomerFilterInterface|null $customerFilter
     *
     * @return StringValueObject
     */
    public function getCustomers(CustomerFilterInterface $customerFilter = null);

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
