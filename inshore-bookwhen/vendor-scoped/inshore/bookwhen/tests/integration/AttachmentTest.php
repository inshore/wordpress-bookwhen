<?php

declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\InShore\Bookwhen\tests\integration;

use _PhpScoper6af4d594edb1\GuzzleHttp\Client as GuzzleClient;
use _PhpScoper6af4d594edb1\GuzzleHttp\Handler\MockHandler;
use _PhpScoper6af4d594edb1\GuzzleHttp\Psr7\Response;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Bookwhen;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\BookwhenApi;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Client;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Domain\Attachment;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Factory;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Exceptions\ConfigurationException;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Exceptions\ValidationException;
use _PhpScoper6af4d594edb1\PHPUnit\Framework\TestCase;
use _PhpScoper6af4d594edb1\Psr\Http\Client\ClientInterface;
use _PhpScoper6af4d594edb1\InShore;
/**
 * @uses InShore\Bookwhen\Validator
 */
class AttachmentTest extends TestCase
{
    protected $apiKey;
    protected $mockHandler;
    protected $client;
    protected $guzzleClient;
    public function setUp() : void
    {
        $this->apiKey = 'dfsdsdsd';
        $this->mockHandler = new MockHandler();
        $this->guzzleClient = new GuzzleClient(['handler' => $this->mockHandler]);
    }
    /**
     * @covers InShore\Bookwhen\Bookwhen
     * @covers InShore\Bookwhen\BookwhenApi
     * @covers InShore\Bookwhen\Client
     * @covers InShore\Bookwhen\Domain\Attachment
     * @covers InShore\Bookwhen\Factory
     * @covers InShore\Bookwhen\Resources\Concerns\Transportable
     * @covers InShore\Bookwhen\Resources\Attachments
     * @covers InShore\Bookwhen\Responses\Attachments\RetrieveResponse
     * @covers InShore\Bookwhen\Transporters\HttpTransporter
     * @covers InShore\Bookwhen\ValueObjects\ApiKey
     * @covers InShore\Bookwhen\ValueObjects\ResourceUri
     * @covers InShore\Bookwhen\ValueObjects\Transporter\BaseUri
     * @covers InShore\Bookwhen\ValueObjects\Transporter\Headers
     * @covers InShore\Bookwhen\ValueObjects\Transporter\Payload
     * @covers InShore\Bookwhen\ValueObjects\Transporter\QueryParams
     */
    public function testValidAttachmentId() : void
    {
        $this->mockHandler->append(new Response(200, [], \file_get_contents(__DIR__ . '/../fixtures/attachment_200.json')));
        $this->client = BookwhenApi::factory()->withApiKey($this->apiKey)->withHttpClient($this->guzzleClient)->make();
        $bookwhen = new Bookwhen(null, $this->client);
        $attachment = $bookwhen->attachment('3wepl3we3kq9');
        $this->assertInstanceOf(Attachment::class, $attachment);
        $this->assertEquals('application/pdf', $attachment->contentType);
        $this->assertEquals('3wepl3we3kq9', $attachment->id);
        $this->assertEquals('CV_2023_daniel_mullin_april.pdf', $attachment->fileName);
        $this->assertEquals('pdf', $attachment->fileType);
        $this->assertEquals(75020, $attachment->fileSizeBytes);
        $this->assertEquals('73.3 KB', $attachment->fileSizeText);
        $this->assertEquals('Cv 2023 Daniel Mullin April', $attachment->title);
    }
}
