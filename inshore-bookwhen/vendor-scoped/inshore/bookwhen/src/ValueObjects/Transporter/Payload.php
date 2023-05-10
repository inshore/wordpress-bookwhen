<?php

declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\InShore\Bookwhen\ValueObjects\Transporter;

use _PhpScoper6af4d594edb1\Http\Discovery\Psr17Factory;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Contracts\Request;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Enums\Transporter\ContentType;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Enums\Transporter\Method;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\ValueObjects\ResourceUri;
use _PhpScoper6af4d594edb1\Psr\Http\Message\RequestInterface;
/**
 * @internal
 */
final class Payload
{
    /**
     * Creates a new Request value object.
     *
     * @param  array<string, mixed>  $parameters
     */
    private function __construct(
        //private readonly ContentType $contentType,
        private readonly Method $method,
        private readonly ResourceUri $uri,
        private readonly array $parameters = []
    )
    {
        // ..
    }
    /**
     * Creates a new Payload value object from the given parameters.
     */
    public static function list(string $resource, array $parameters = []) : self
    {
        //var_export($parameters);
        //$contentType = ContentType::JSON;
        $method = Method::GET;
        $uri = ResourceUri::list($resource);
        return new self($method, $uri, $parameters);
    }
    /**
     * Creates a new Payload value object from the given parameters.
     */
    public static function retrieve(string $resource, string $id, array $parameters = []) : self
    {
        // $contentType = ContentType::JSON;
        $method = Method::GET;
        $uri = ResourceUri::retrieve($resource, $id);
        return new self($method, $uri, $parameters);
    }
    /**
     * Creates a new Psr 7 Request instance.
     */
    public function toRequest(BaseUri $baseUri, Headers $headers, QueryParams $queryParams) : RequestInterface
    {
        $psr17Factory = new Psr17Factory();
        $uri = $baseUri->toString() . $this->uri->toString();
        if (!empty($this->parameters)) {
            $uri .= '?' . \http_build_query($this->parameters);
        }
        $request = $psr17Factory->createRequest($this->method->value, $uri);
        foreach ($headers->toArray() as $name => $value) {
            $request = $request->withHeader($name, $value);
        }
        return $request;
    }
}
