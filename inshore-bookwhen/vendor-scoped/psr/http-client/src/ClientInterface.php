<?php

namespace _PhpScoper6af4d594edb1\Psr\Http\Client;

use _PhpScoper6af4d594edb1\Psr\Http\Message\RequestInterface;
use _PhpScoper6af4d594edb1\Psr\Http\Message\ResponseInterface;
interface ClientInterface
{
    /**
     * Sends a PSR-7 request and returns a PSR-7 response.
     *
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     *
     * @throws \Psr\Http\Client\ClientExceptionInterface If an error happens while processing the request.
     */
    public function sendRequest(RequestInterface $request) : ResponseInterface;
}
