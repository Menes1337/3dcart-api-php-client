<?php

namespace ThreeDCart\Api\Rest\Filter;

use ThreeDCart\Api\Rest\Request\HttpParameterList;
use ThreeDCart\Primitive\BooleanValueObject;
use ThreeDCart\Primitive\IntegerValueObject;
use ThreeDCart\Primitive\StringValueObject;
use ThreeDCart\Primitive\UnsignedIntegerValueObject;

/**
 * @package ThreeDCart\Api\Rest\Filter
 *
 */
interface CustomerFilterInterface
{
    /**
     * @param StringValueObject $email
     */
    public function filterEmail(StringValueObject $email);
    
    /**
     * @param Limit $limit between 0 and 500
     *
     * @throws \InvalidArgumentException
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
     * @param StringValueObject $firstName
     */
    public function filterFirstName(StringValueObject $firstName);
    
    /**
     * @param StringValueObject $lastName
     */
    public function filterLastName(StringValueObject $lastName);
    
    /**
     * @param StringValueObject $country
     */
    public function filterCountry(StringValueObject $country);
    
    /**
     * @param StringValueObject $state
     */
    public function filterState(StringValueObject $state);
    
    /**
     * @param StringValueObject $city
     */
    public function filterCity(StringValueObject $city);
    
    /**
     * @param StringValueObject $phone
     */
    public function filterPhone(StringValueObject $phone);
    
    /**
     * @param StringValueObject $lastUpdateStart
     */
    public function filterLastUpdateStart(StringValueObject $lastUpdateStart);
    
    /**
     * @param StringValueObject $lastUpdateEnd
     */
    public function filterLastUpdateEnd(StringValueObject $lastUpdateEnd);
    
    /**
     * @return HttpParameterList
     */
    public function getHttpParameterList();
    
    /**
     * @post the filter will have no active entries
     */
    public function clear();
    
    /**
     * @return BooleanValueObject will return whether the filter has active entries or not
     */
    public function isEmpty();
    
    /**
     * @return IntegerValueObject will return the number of active entries in the filter
     */
    public function count();
    
}
