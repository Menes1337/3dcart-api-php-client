<?php

namespace ThreeDCart\Api\Rest\Resource\Product;

use ThreeDCart\Api\Rest\Resource\AbstractResource;

/**
 * @package ThreeDCart\Api\Rest\Resource\Product
 *
 * @method static EProduct fromArray(array $data)
 * @method static EProduct[] fromList(array $list)
 */
class EProduct extends AbstractResource
{
    /** @var int */
    public $FileNumber;
    
    /** @var string */
    public $FilePath;
}
