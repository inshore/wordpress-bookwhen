<?php

declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\InShore\Bookwhen\Exceptions;

use Exception;
use _PhpScoper6af4d594edb1\Psr\Http\Client\ClientExceptionInterface;
final class TransporterException extends Exception
{
    /**
     * Creates a new Exception instance.
     */
    public function __construct(ClientExceptionInterface $exception)
    {
        parent::__construct($exception->getMessage(), 0, $exception);
    }
}
