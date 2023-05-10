<?php

declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\InShore\Bookwhen\Contracts;

use _PhpScoper6af4d594edb1\InShore\Bookwhen\Exceptions\ErrorException;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Exceptions\TransporterException;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Exceptions\UnserializableResponse;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\ValueObjects\Transporter\Payload;
use _PhpScoper6af4d594edb1\Psr\Http\Message\ResponseInterface;
/**
 * @internal
 */
interface TransporterContract
{
    /**
     * Sends a request to a server.
     **
     * @return array<array-key, mixed>
     *
     * @throws ErrorException|UnserializableResponse|TransporterException
     */
    public function requestObject(Payload $payload) : array;
}
