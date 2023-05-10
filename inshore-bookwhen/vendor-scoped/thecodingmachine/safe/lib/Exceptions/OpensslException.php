<?php

namespace _PhpScoper6af4d594edb1\Safe\Exceptions;

class OpensslException extends \Exception implements SafeExceptionInterface
{
    public static function createFromPhpError() : self
    {
        return new self(\openssl_error_string() ?: '', 0);
    }
}
