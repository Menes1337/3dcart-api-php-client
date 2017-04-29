<?php

namespace ThreeDCart\Api\Rest\Request;

use ThreeDCart\Primitive\StringValueObject;

interface HandlerInterface
{
    /**
     * @param HttpMethod        $httpMethod
     * @param ApiPathAppendix   $apiPathAppendix
     * @param HttpParameterList $httpGetParameterList
     * @param HttpParameterList $httpPostParameterList
     *
     * @return StringValueObject
     */
    public function request(
        HttpMethod $httpMethod,
        ApiPathAppendix $apiPathAppendix,
        HttpParameterList $httpGetParameterList,
        HttpParameterList $httpPostParameterList
    );
}
