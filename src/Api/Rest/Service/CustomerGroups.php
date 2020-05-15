<?php

namespace ThreeDCart\Api\Rest\Service;

use ThreeDCart\Api\Rest\Filter\FilterListInterface;
use ThreeDCart\Api\Rest\Resource\CustomerGroup;
use ThreeDCart\Api\Rest\Select\SelectListInterface;
use ThreeDCart\Api\Rest\Sort\SortInterface;

/**
 * @package ThreeDCart\Api\Rest\Request\Service
 */
class CustomerGroups extends AbstractService implements CustomerGroupsInterface
{
    public function getCustomerGroups(
        SelectListInterface $selectList = null,
        FilterListInterface $filterList = null,
        SortInterface $sortOrderList = null
    ) {
        $rawResponse = $this->sendRequest($selectList, $filterList, $sortOrderList);
        
        return CustomerGroup::fromList(json_decode($rawResponse->getStringValue(), true));
    }
}
