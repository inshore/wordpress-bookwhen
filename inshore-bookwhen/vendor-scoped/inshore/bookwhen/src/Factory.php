<?php

namespace _PhpScoper6af4d594edb1\InShore\Bookwhen;

use _PhpScoper6af4d594edb1\Http\Discovery\Psr18ClientDiscovery;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Transporters\HttpTransporter;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\ValueObjects\ApiKey;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\ValueObjects\Transporter\BaseUri;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\ValueObjects\Transporter\Headers;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\ValueObjects\Transporter\QueryParams;
use _PhpScoper6af4d594edb1\Psr\Http\Client\ClientInterface;
use _PhpScoper6af4d594edb1\Symfony\Component\HttpClient\Psr18Client;
final class Factory
{
    /**
     * The API key for the requests.
     */
    private ?string $apiKey = null;
    /**
     * The HTTP client for the requests.
     */
    private ?ClientInterface $httpClient = null;
    /**
     * The base URI for the requests.
     */
    private ?string $baseUri = null;
    /**
     * The query parameters for the requests.
     *
     * @var array<string, string|int>
     */
    private array $queryParams = [];
    /**
     * Sets the API key for the requests.
     */
    public function withApiKey(string $apiKey) : self
    {
        $this->apiKey = \trim($apiKey);
        return $this;
    }
    /**
     * Sets the base URI for the requests.
     * If no URI is provided the factory will use the default OpenAI API URI.
     */
    public function withBaseUri(string $baseUri) : self
    {
        $this->baseUri = $baseUri;
        return $this;
    }
    /**
     * Sets the HTTP client for the requests.
     * If no client is provided the factory will try to find one using PSR-18 HTTP Client Discovery.
     */
    public function withHttpClient(ClientInterface $client) : self
    {
        $this->httpClient = $client;
        return $this;
    }
    /**
     * Adds a custom query parameter to the request url.
     */
    public function withQueryParam(string $name, string $value) : self
    {
        $this->queryParams[$name] = $value;
        return $this;
    }
    /**
     * Creates a new Open AI Client.
     */
    public function make() : Client
    {
        $headers = Headers::create();
        if (null !== $this->apiKey) {
            $headers = Headers::withAuthorization(ApiKey::from($this->apiKey));
        }
        $baseUri = BaseUri::from($this->baseUri ?: 'api.bookwhen.com/v2');
        $queryParams = QueryParams::create();
        foreach ($this->queryParams as $name => $value) {
            $queryParams = $queryParams->withParam($name, $value);
        }
        $client = $this->httpClient ??= Psr18ClientDiscovery::find();
        $transporter = new HttpTransporter($client, $baseUri, $headers, $queryParams);
        return new Client($transporter);
    }
}
