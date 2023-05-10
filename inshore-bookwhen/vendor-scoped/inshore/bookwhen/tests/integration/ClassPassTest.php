<?php

declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\InShore\Bookwhen\tests\integration;

use _PhpScoper6af4d594edb1\GuzzleHttp\Client as GuzzleClient;
use _PhpScoper6af4d594edb1\GuzzleHttp\Handler\MockHandler;
use _PhpScoper6af4d594edb1\GuzzleHttp\Psr7\Response;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Bookwhen;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\BookwhenApi;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Client;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Domain\ClassPass;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Factory;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Exceptions\ConfigurationException;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Exceptions\ValidationException;
use _PhpScoper6af4d594edb1\PHPUnit\Framework\TestCase;
use _PhpScoper6af4d594edb1\Psr\Http\Client\ClientInterface;
use _PhpScoper6af4d594edb1\InShore;
/**
 * @uses InShore\Bookwhen\Validator
 */
class ClassPassTest extends TestCase
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
     * @covers InShore\Bookwhen\Domain\Event
     * @covers InShore\Bookwhen\Domain\ClassPass
     * @covers InShore\Bookwhen\Domain\ClassPass
     * @covers InShore\Bookwhen\Factory
     * @covers InShore\Bookwhen\Resources\Concerns\Transportable
     * @covers InShore\Bookwhen\Resources\ClassPasses
     * @covers InShore\Bookwhen\Responses\ClassPasses\RetrieveResponse
     * @covers InShore\Bookwhen\Responses\ClassPasses\RetrieveResponse
     * @covers InShore\Bookwhen\Transporters\HttpTransporter
     * @covers InShore\Bookwhen\ValueObjects\ApiKey
     * @covers InShore\Bookwhen\ValueObjects\ResourceUri
     * @covers InShore\Bookwhen\ValueObjects\Transporter\BaseUri
     * @covers InShore\Bookwhen\ValueObjects\Transporter\Headers
     * @covers InShore\Bookwhen\ValueObjects\Transporter\Payload
     * @covers InShore\Bookwhen\ValueObjects\Transporter\QueryParams
     */
    public function testValidClassPassId() : void
    {
        $this->mockHandler->append(new Response(200, [], \file_get_contents(__DIR__ . '/../fixtures/classpass_200.json')));
        $this->client = BookwhenApi::factory()->withApiKey($this->apiKey)->withHttpClient($this->guzzleClient)->make();
        $bookwhen = new Bookwhen(null, $this->client);
        $classPass = $bookwhen->classPass('cp-qkrrxz0zh8i0');
        $this->assertInstanceOf(ClassPass::class, $classPass);
        $this->assertEquals('', $classPass->details);
        $this->assertEquals('cp-qkrrxz0zh8i0', $classPass->id);
        $this->assertNull($classPass->numberAvailable);
        $this->assertEquals('8 x I000 inShore 4 Hour Product Engineer Consultation (15% discount save GBP 320)', $classPass->title);
        $this->assertEquals(8, $classPass->usageAllowance);
        $this->assertEquals('personal', $classPass->usageType);
        $this->assertNull($classPass->useRestrictedForDays);
    }
}
