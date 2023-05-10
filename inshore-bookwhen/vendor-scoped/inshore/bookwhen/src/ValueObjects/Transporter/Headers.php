<?php

declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\InShore\Bookwhen\ValueObjects\Transporter;

use _PhpScoper6af4d594edb1\InShore\Bookwhen\ValueObjects\ApiKey;
/**
 * @internal
 */
final class Headers
{
    /**
     * Creates a new Headers value object.
     *
     * @param  array<string, string>  $headers
     */
    private function __construct(private readonly array $headers)
    {
        // ..
    }
    /**
     * Creates a new Headers value object
     */
    public static function create() : self
    {
        return new self([]);
    }
    /**
     * Creates a new Headers value object with the given API token.
     */
    public static function withAuthorization(ApiKey $apiKey) : self
    {
        return new self(['Authorization' => 'Basic ' . \base64_encode($apiKey->toString() . ':')]);
    }
    /**
     * Creates a new Headers value object, with the given content type, and the existing headers.
     */
    public function withContentType() : self
    {
        return new self([...$this->headers, 'Content-Type' => 'application/json']);
    }
    /**
     * @return array<string, string> $headers
     */
    public function toArray() : array
    {
        return $this->headers;
    }
}
