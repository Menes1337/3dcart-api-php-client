<?php

namespace ThreeDCart\Api\Rest\Service;

use ThreeDCart\Api\Rest\Filter\CustomerFilterInterface;
use ThreeDCart\Api\Rest\Request\ApiPathAppendix;
use ThreeDCart\Api\Rest\Request\HttpMethod;
use ThreeDCart\Api\Rest\Request\HttpParameterList;

/**
 * Class Customers
 *
 * @package ThreeDCart\Api\Rest\Request\Service
 */
class Customers extends AbstractService implements CustomersInterface
{
    public function getCustomers(CustomerFilterInterface $customerFilter = null)
    {
        return $this->requestHandler->request(
            new HttpMethod(HttpMethod::HTTP_METHOD_GET),
            new ApiPathAppendix(''),
            $customerFilter !== null ? $customerFilter->getHttpParameterList() : new HttpParameterList(),
            new HttpParameterList()
        );
    }
}
