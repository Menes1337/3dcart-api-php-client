<?php

namespace ThreeDCart\Api\Rest\Service;

use ThreeDCart\Api\Rest\Filter\FilterListInterface;
use ThreeDCart\Api\Rest\Request\RequestException;
use ThreeDCart\Api\Rest\Resource\Product;
use ThreeDCart\Api\Rest\Select\SelectListInterface;
use ThreeDCart\Api\Rest\Sort\SortInterface;

interface ProductsInterface
{
    /**
     * @param SelectListInterface|null $selectList
     * @param FilterListInterface|null $filterList
     * @param SortInterface|null       $sortOrderList
     *
     * @return Product[]
     *
     * @throws RequestException
     */
    public function getProducts(
        SelectListInterface $selectList = null,
        FilterListInterface $filterList = null,
        SortInterface $sortOrderList = null
    );
    
    //    public function getCategory(CategoryId $categoryId);
}
