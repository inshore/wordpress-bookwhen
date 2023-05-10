<?php

declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\StubTests\TestData\Providers;

use _PhpScoper6af4d594edb1\StubTests\Model\StubsContainer;
use _PhpScoper6af4d594edb1\StubTests\Parsers\StubParser;
class PhpStormStubsSingleton
{
    private static ?StubsContainer $phpstormStubs = null;
    public static function getPhpStormStubs() : StubsContainer
    {
        if (self::$phpstormStubs === null) {
            self::$phpstormStubs = StubParser::getPhpStormStubs();
        }
        return self::$phpstormStubs;
    }
}
