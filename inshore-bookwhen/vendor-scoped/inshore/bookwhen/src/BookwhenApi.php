<?php

declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\InShore\Bookwhen;

use _PhpScoper6af4d594edb1\InShore\Bookwhen\Client;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Factory;
final class BookwhenApi
{
    /**
     * Creates a new Bookwhen Client with the given API token.
     */
    public static function client(string $apiKey) : Client
    {
        return self::factory()->withApiKey($apiKey)->make();
    }
    /**
     * Creates a new factory instance to configure a custom Bookwhen Client
     */
    public static function factory() : Factory
    {
        return new Factory();
    }
}
