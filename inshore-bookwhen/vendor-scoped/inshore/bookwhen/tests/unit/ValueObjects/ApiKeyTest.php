<?php

declare (strict_types=1);
namespace _PhpScoper6af4d594edb1;

use _PhpScoper6af4d594edb1\InShore\Bookwhen\ValueObjects\ApiKey;
use _PhpScoper6af4d594edb1\PHPUnit\Framework\TestCase;
final class ApiKeyTest extends TestCase
{
    public static function provideInvalidApiKeys() : array
    {
        return ['null' => [null], 'emptyString' => [''], 'object' => [new \stdClass()]];
    }
    public static function provideValidApiKey() : array
    {
        return ['string' => ['fdhldfhjsflkds']];
    }
    /**
     * @covers InShore\Bookwhen\ValueObjects\ApiKey::__construct()
     * @covers InShore\Bookwhen\ValueObjects\ApiKey::from()
     * @dataProvider provideInvalidApiKeys
     */
    public function testInvalidApiKey($testApiKey) : void
    {
        if (\is_string($testApiKey)) {
            $this->expectException(\InvalidArgumentException::class);
        } else {
            $this->expectException(\TypeError::class);
        }
        $apiKey = ApiKey::from($testApiKey);
    }
    /**
     * @covers InShore\Bookwhen\ValueObjects\ApiKey::__construct()
     * @covers InShore\Bookwhen\ValueObjects\ApiKey::from
     * @covers InShore\Bookwhen\ValueObjects\ApiKey::toString()
     * @dataProvider provideValidApiKey
     */
    public function testValidApiKey($testApiKey) : void
    {
        $apiKey = ApiKey::from($testApiKey);
        $this->assertSame($testApiKey, $apiKey->toString());
    }
}
\class_alias('_PhpScoper6af4d594edb1\\ApiKeyTest', 'ApiKeyTest', \false);
