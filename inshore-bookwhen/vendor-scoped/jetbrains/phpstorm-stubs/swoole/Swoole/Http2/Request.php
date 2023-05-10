<?php

declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\Swoole\Http2;

class Request
{
    public $path = '/';
    public $method = 'GET';
    public $headers;
    public $cookies;
    public $data = '';
    public $pipeline = \false;
}
