<?php

declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\PhpParser\ErrorHandler;

use _PhpScoper6af4d594edb1\PhpParser\Error;
use _PhpScoper6af4d594edb1\PhpParser\ErrorHandler;
/**
 * Error handler that handles all errors by throwing them.
 *
 * This is the default strategy used by all components.
 */
class Throwing implements ErrorHandler
{
    public function handleError(Error $error)
    {
        throw $error;
    }
}
