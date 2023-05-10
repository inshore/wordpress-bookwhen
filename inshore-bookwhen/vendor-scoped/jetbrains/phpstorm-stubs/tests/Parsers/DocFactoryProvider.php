<?php

declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\StubTests\Parsers;

use _PhpScoper6af4d594edb1\phpDocumentor\Reflection\DocBlockFactory;
use _PhpScoper6af4d594edb1\StubTests\Model\Tags\RemovedTag;
class DocFactoryProvider
{
    private static ?DocBlockFactory $docFactory = null;
    public static function getDocFactory() : DocBlockFactory
    {
        if (self::$docFactory === null) {
            self::$docFactory = DocBlockFactory::createInstance(['removed' => RemovedTag::class]);
        }
        return self::$docFactory;
    }
}
