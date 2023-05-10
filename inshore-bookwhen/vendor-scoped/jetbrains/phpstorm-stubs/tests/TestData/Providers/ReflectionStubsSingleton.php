<?php

namespace _PhpScoper6af4d594edb1\StubTests\TestData\Providers;

use _PhpScoper6af4d594edb1\StubTests\Model\StubsContainer;
use _PhpScoper6af4d594edb1\StubTests\Parsers\PHPReflectionParser;
class ReflectionStubsSingleton
{
    /**
     * @var StubsContainer|null
     */
    private static $reflectionStubs;
    /**
     * @return StubsContainer
     */
    public static function getReflectionStubs()
    {
        if (self::$reflectionStubs === null) {
            self::$reflectionStubs = PHPReflectionParser::getStubs();
        }
        return self::$reflectionStubs;
    }
}
