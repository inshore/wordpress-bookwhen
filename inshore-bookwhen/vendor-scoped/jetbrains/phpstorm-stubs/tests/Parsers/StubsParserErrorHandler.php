<?php

declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\StubTests\Parsers;

use _PhpScoper6af4d594edb1\PhpParser\Error;
use _PhpScoper6af4d594edb1\PhpParser\ErrorHandler;
class StubsParserErrorHandler implements ErrorHandler
{
    public function handleError(Error $error) : void
    {
        $error->setRawMessage($error->getRawMessage() . "\n" . $error->getFile());
    }
}
