<?php

namespace _PhpScoper6af4d594edb1\GuzzleHttp;

use _PhpScoper6af4d594edb1\Psr\Http\Message\MessageInterface;
interface BodySummarizerInterface
{
    /**
     * Returns a summarized message body.
     */
    public function summarize(MessageInterface $message) : ?string;
}
