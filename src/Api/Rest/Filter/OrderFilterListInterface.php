<?php

namespace ThreeDCart\Api\Rest\Filter;

use ThreeDCart\Api\Rest\Filter\Order\Limit;
use ThreeDCart\Primitive\BooleanValueObject;
use ThreeDCart\Primitive\IntegerValueObject;
use ThreeDCart\Primitive\StringValueObject;
use ThreeDCart\Primitive\UnsignedIntegerValueObject;

/**
 * @package ThreeDCart\Api\Rest\Filter
 */
interface OrderFilterListInterface extends FilterListInterface
{
    /**
     * @param IntegerValueObject $invoiceNumber
     */
    public function filterInvoiceNumber(IntegerValueObject $invoiceNumber);
    
    /**
     * @param IntegerValueObject $orderStatus
     */
    public function filterOrderStatus(IntegerValueObject $orderStatus);
    
    /**
     * @param StringValueObject $dateStart
     */
    public function filterDateStart(StringValueObject $dateStart);
    
    /**
     * @param StringValueObject $dateEnd
     */
    public function filterDateEnd(StringValueObject $dateEnd);
    
    /**
     * @param Limit $limit
     */
    public function filterLimit(Limit $limit);
    
    /**
     * @param UnsignedIntegerValueObject $offset
     */
    public function filterOffset(UnsignedIntegerValueObject $offset);
    
    /**
     * @param BooleanValueObject $countOnly
     */
    public function filterCountOnly(BooleanValueObject $countOnly);
    
    /**
     * @param StringValueObject $lastUpdateStart
     */
    public function filterLastUpdateStart(StringValueObject $lastUpdateStart);
    
    /**
     * @param StringValueObject $lastUpdateEnd
     */
    public function filterLastUpdateEnd(StringValueObject $lastUpdateEnd);
}
