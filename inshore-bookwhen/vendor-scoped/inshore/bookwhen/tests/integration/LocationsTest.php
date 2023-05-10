<?php

declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\InShore\Bookwhen\tests\integration;

use _PhpScoper6af4d594edb1\GuzzleHttp\Client as GuzzleClient;
use _PhpScoper6af4d594edb1\GuzzleHttp\Handler\MockHandler;
use _PhpScoper6af4d594edb1\GuzzleHttp\Psr7\Response;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Bookwhen;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\BookwhenApi;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Client;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Domain\Location;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Factory;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Exceptions\ConfigurationException;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Exceptions\ValidationException;
use _PhpScoper6af4d594edb1\PHPUnit\Framework\TestCase;
use _PhpScoper6af4d594edb1\Psr\Http\Client\ClientInterface;
use _PhpScoper6af4d594edb1\InShore;
/**
 * @uses InShore\Bookwhen\Validator
 */
class LocationsTest extends TestCase
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
     * @covers InShore\Bookwhen\Domain\Location
     * @covers InShore\Bookwhen\Domain\Ticket
     * @covers InShore\Bookwhen\Factory
     * @covers InShore\Bookwhen\Resources\Concerns\Transportable
     * @covers InShore\Bookwhen\Resources\Locations
     * @covers InShore\Bookwhen\Responses\Locations\ListResponse
     * @covers InShore\Bookwhen\Responses\Locations\RetrieveResponse
     * @covers InShore\Bookwhen\Responses\Tickets\RetrieveResponse
     * @covers InShore\Bookwhen\Transporters\HttpTransporter
     * @covers InShore\Bookwhen\ValueObjects\ApiKey
     * @covers InShore\Bookwhen\ValueObjects\ResourceUri
     * @covers InShore\Bookwhen\ValueObjects\Transporter\BaseUri
     * @covers InShore\Bookwhen\ValueObjects\Transporter\Headers
     * @covers InShore\Bookwhen\ValueObjects\Transporter\Payload
     * @covers InShore\Bookwhen\ValueObjects\Transporter\QueryParams
     */
    public function testValids() : void
    {
        $this->mockHandler->append(new Response(200, [], \file_get_contents(__DIR__ . '/../fixtures/locations_200.json')));
        $this->client = BookwhenApi::factory()->withApiKey($this->apiKey)->withHttpClient($this->guzzleClient)->make();
        $bookwhen = new Bookwhen(null, $this->client);
        $locations = $bookwhen->locations();
        $this->assertIsArray($locations);
        $this->assertInstanceOf(Location::class, $locations[2]);
        $this->assertEquals('Online', $locations[2]->additionalInfo);
        $this->assertEquals('Zoom', $locations[2]->addressText);
        $this->assertEquals(49.21879, $locations[2]->latitude);
        $this->assertEquals(-2.12625, $locations[2]->longitude);
        $this->assertEquals('w0uh48ad3fm2', $locations[2]->id);
    }
}
