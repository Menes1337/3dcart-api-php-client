<?php

namespace ThreeDCart\Api\Soap\Request;

use ThreeDCart\Api\Soap\Response\Xml;
use ThreeDCart\Primitive\StringValueObject;

/**
 * Interface AdvancedClientInterface
 *
 * @package ThreeDCart\Api\Soap\Request
 */
interface AdvancedClientInterface
{
    /**
     * @param StringValueObject $sql
     * @param StringValueObject $callBackUrl
     *
     * @return Xml
     *
     * @throws ResponseInvalidException
     */
    public function runQuery(StringValueObject $sql, StringValueObject $callBackUrl = null);
}
