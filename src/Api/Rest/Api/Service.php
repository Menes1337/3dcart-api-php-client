<?php

namespace ThreeDCart\Api\Rest\Api;

use ThreeDCart\Primitive\Enum;
use ThreeDCart\Primitive\StringValueObject;

class Service extends Enum
{
    const CATEGORIES      = 'Categories';
    const RMA             = 'RMA';
    const CUSTOMER_GROUPS = 'CustomerGroups';
    const GIFT_REGISTRIES = 'GiftRegistries';
    const CUSTOMERS       = 'Customers';
    const DISTRIBUTORS    = 'Distributors';
    const PRODUCTS        = 'Products';
    const MANUFACTURER    = 'Manufacturer';
    const ORDERS          = 'Orders';
    
    public static $allowedValues = array(
        self::CATEGORIES,
        self::CUSTOMER_GROUPS,
        self::CUSTOMERS,
        self::DISTRIBUTORS,
        self::GIFT_REGISTRIES,
        self::MANUFACTURER,
        self::ORDERS,
        self::PRODUCTS,
        self::RMA
    );
    
    /**
     * @return string
     */
    public function getStringValue()
    {
        return $this->getValue();
    }
}
