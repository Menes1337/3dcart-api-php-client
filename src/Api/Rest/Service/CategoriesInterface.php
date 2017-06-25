<?php

namespace ThreeDCart\Api\Rest\Service;

use ThreeDCart\Api\Rest\Filter\FilterInterface;
use ThreeDCart\Api\Rest\Request\RequestException;
use ThreeDCart\Api\Rest\Resource\Category;
use ThreeDCart\Api\Rest\Select\SelectListInterface;
use ThreeDCart\Api\Rest\Sort\SortInterface;

interface CategoriesInterface
{
    /**
     * @param SelectListInterface|null $selectList
     * @param FilterInterface|null     $filterList
     * @param SortInterface|null       $sortOrderList
     *
     * @return Category[]
     *
     * @throws RequestException
     */
    public function getCategories(
        SelectListInterface $selectList = null,
        FilterInterface $filterList = null,
        SortInterface $sortOrderList = null
    );

//    public function getCategory(CategoryId $categoryId);
}
