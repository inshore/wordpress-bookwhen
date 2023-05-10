<?php

namespace _PhpScoper6af4d594edb1\Safe\Exceptions;

class CurlException extends \Exception implements SafeExceptionInterface
{
    /**
     * @param \CurlHandle $ch
     */
    public static function createFromPhpError($ch = null) : self
    {
        return new self($ch ? \curl_error($ch) : '', $ch ? \curl_errno($ch) : 0);
    }
}
