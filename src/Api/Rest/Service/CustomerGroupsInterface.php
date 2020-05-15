<?php

namespace ThreeDCart\Api\Rest\Service;

use ThreeDCart\Api\Rest\Filter\FilterListInterface;
use ThreeDCart\Api\Rest\Request\RequestException;
use ThreeDCart\Api\Rest\Resource\CustomerGroup;
use ThreeDCart\Api\Rest\Select\SelectListInterface;
use ThreeDCart\Api\Rest\Sort\SortInterface;

interface CustomerGroupsInterface
{
    /**
     * @param SelectListInterface|null $selectList
     * @param FilterListInterface|null $filterList
     * @param SortInterface|null       $sortOrderList
     *
     * @return CustomerGroup[]
     *
     * @throws RequestException
     */
    public function getCustomerGroups(
        SelectListInterface $selectList = null,
        FilterListInterface $filterList = null,
        SortInterface $sortOrderList = null
    );

    //    public function getCategory(CategoryId $categoryId);
}
