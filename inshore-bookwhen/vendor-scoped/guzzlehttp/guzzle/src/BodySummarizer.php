<?php

namespace _PhpScoper6af4d594edb1\GuzzleHttp;

use _PhpScoper6af4d594edb1\Psr\Http\Message\MessageInterface;
final class BodySummarizer implements BodySummarizerInterface
{
    /**
     * @var int|null
     */
    private $truncateAt;
    public function __construct(int $truncateAt = null)
    {
        $this->truncateAt = $truncateAt;
    }
    /**
     * Returns a summarized message body.
     */
    public function summarize(MessageInterface $message) : ?string
    {
        return $this->truncateAt === null ? \_PhpScoper6af4d594edb1\GuzzleHttp\Psr7\Message::bodySummary($message) : \_PhpScoper6af4d594edb1\GuzzleHttp\Psr7\Message::bodySummary($message, $this->truncateAt);
    }
}
