<?php

namespace ThreeDCart\Api\Rest\Request;

use ThreeDCart\Primitive\StringValueObject;

interface RequestInterface
{
    /**
     * @param HttpMethod        $httpMethod
     * @param ApiPathAppendix   $apiPathAppendix
     * @param HttpParameterList $httpGetParameterList
     * @param HttpParameterList $httpPostParameterList
     *
     * @return StringValueObject
     *
     * @throws RequestException
     */
    public function send(
        HttpMethod $httpMethod,
        ApiPathAppendix $apiPathAppendix,
        HttpParameterList $httpGetParameterList,
        HttpParameterList $httpPostParameterList
    );
}
