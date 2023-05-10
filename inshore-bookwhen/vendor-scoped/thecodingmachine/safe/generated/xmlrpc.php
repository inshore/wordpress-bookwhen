<?php

namespace _PhpScoper6af4d594edb1\Safe;

use _PhpScoper6af4d594edb1\Safe\Exceptions\XmlrpcException;
/**
 * Sets xmlrpc type, base64 or datetime, for a PHP string value.
 *
 * @param string|\DateTime $value Value to set the type
 * @param string $type 'base64' or 'datetime'
 * @throws XmlrpcException
 *
 */
function xmlrpc_set_type(&$value, string $type) : void
{
    \error_clear_last();
    $safeResult = \xmlrpc_set_type($value, $type);
    if ($safeResult === \false) {
        throw XmlrpcException::createFromPhpError();
    }
}
