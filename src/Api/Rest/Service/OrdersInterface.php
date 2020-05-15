<?php

namespace ThreeDCart\Api\Rest\Service;

use ThreeDCart\Api\Rest\Filter\FilterListInterface;
use ThreeDCart\Api\Rest\Request\RequestException;
use ThreeDCart\Api\Rest\Resource\Order;
use ThreeDCart\Api\Rest\Select\SelectListInterface;
use ThreeDCart\Api\Rest\Sort\SortInterface;

interface OrdersInterface
{
    /**
     * @param SelectListInterface|null $selectList
     * @param FilterListInterface|null $filterList
     * @param SortInterface|null       $sortOrderList
     *
     * @return Order[]
     *
     * @throws RequestException
     */
    public function getOrders(
        SelectListInterface $selectList = null,
        FilterListInterface $filterList = null,
        SortInterface $sortOrderList = null
    );
}
