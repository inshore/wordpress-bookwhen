<?php

namespace _PhpScoper6af4d594edb1\Http\Discovery;

use _PhpScoper6af4d594edb1\Psr\Http\Client\ClientInterface;
use _PhpScoper6af4d594edb1\Psr\Http\Message\RequestFactoryInterface;
use _PhpScoper6af4d594edb1\Psr\Http\Message\RequestInterface;
use _PhpScoper6af4d594edb1\Psr\Http\Message\ResponseFactoryInterface;
use _PhpScoper6af4d594edb1\Psr\Http\Message\ResponseInterface;
use _PhpScoper6af4d594edb1\Psr\Http\Message\ServerRequestFactoryInterface;
use _PhpScoper6af4d594edb1\Psr\Http\Message\StreamFactoryInterface;
use _PhpScoper6af4d594edb1\Psr\Http\Message\UploadedFileFactoryInterface;
use _PhpScoper6af4d594edb1\Psr\Http\Message\UriFactoryInterface;
/**
 * A generic PSR-18 and PSR-17 implementation.
 *
 * You can create this class with concrete client and factory instances
 * or let it use discovery to find suitable implementations as needed.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 */
class Psr18Client extends Psr17Factory implements ClientInterface
{
    private $client;
    public function __construct(ClientInterface $client = null, RequestFactoryInterface $requestFactory = null, ResponseFactoryInterface $responseFactory = null, ServerRequestFactoryInterface $serverRequestFactory = null, StreamFactoryInterface $streamFactory = null, UploadedFileFactoryInterface $uploadedFileFactory = null, UriFactoryInterface $uriFactory = null)
    {
        parent::__construct($requestFactory, $responseFactory, $serverRequestFactory, $streamFactory, $uploadedFileFactory, $uriFactory);
        $this->client = $client ?? Psr18ClientDiscovery::find();
    }
    public function sendRequest(RequestInterface $request) : ResponseInterface
    {
        return $this->client->sendRequest($request);
    }
}
