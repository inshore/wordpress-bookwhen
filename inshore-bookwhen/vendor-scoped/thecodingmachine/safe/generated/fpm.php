<?php

namespace _PhpScoper6af4d594edb1\Safe;

use _PhpScoper6af4d594edb1\Safe\Exceptions\FpmException;
/**
 * This function flushes all response data to the client and finishes the
 * request. This allows for time consuming tasks to be performed without
 * leaving the connection to the client open.
 *
 * @throws FpmException
 *
 */
function fastcgi_finish_request() : void
{
    \error_clear_last();
    $safeResult = \fastcgi_finish_request();
    if ($safeResult === \false) {
        throw FpmException::createFromPhpError();
    }
}
