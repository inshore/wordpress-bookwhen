<?php

declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\InShore\Bookwhen\Transporters;

use JsonException;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Contracts\TransporterContract;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Exceptions\ErrorException;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Exceptions\TransporterException;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Exceptions\UnserializableResponse;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\ValueObjects\Transporter\BaseUri;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\ValueObjects\Transporter\Headers;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\ValueObjects\Transporter\Payload;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\ValueObjects\Transporter\QueryParams;
use _PhpScoper6af4d594edb1\Psr\Http\Client\ClientExceptionInterface;
use _PhpScoper6af4d594edb1\Psr\Http\Client\ClientInterface;
use _PhpScoper6af4d594edb1\Psr\Http\Message\ResponseInterface;
/**
 * @internal
 */
final class HttpTransporter implements TransporterContract
{
    /**
     * Creates a new Http Transporter instance.
     */
    public function __construct(private readonly ClientInterface $client, private readonly BaseUri $baseUri, private readonly Headers $headers, private readonly QueryParams $queryParams)
    {
        // ..
    }
    /**
     * {@inheritDoc}
     */
    public function requestObject(Payload $payload) : array
    {
        $request = $payload->toRequest($this->baseUri, $this->headers, $this->queryParams);
        try {
            $response = $this->client->sendRequest($request);
        } catch (ClientExceptionInterface $clientException) {
            throw new TransporterException($clientException);
        }
        $contents = (string) $response->getBody();
        //         if ('text/plain; charset=utf-8' === $response->getHeader('Content-Type')[0]) {
        //             return $contents;
        //         }
        try {
            /** @var array{error?: array{message: string, type: string, code: string}} $response */
            $response = \json_decode($contents, \true, 512, \JSON_THROW_ON_ERROR);
        } catch (JsonException $jsonException) {
            throw new UnserializableResponse($jsonException);
        }
        if (isset($response['error'])) {
            throw new ErrorException($response['error']);
        }
        return $response;
    }
}
