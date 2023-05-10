<?php

namespace _PhpScoper6af4d594edb1\StubTests\TestData\Providers\Stubs;

use Generator;
use _PhpScoper6af4d594edb1\StubTests\TestData\Providers\PhpStormStubsSingleton;
class StubsCompositeMixedProvider
{
    public function expectedFunctionsMixedFalseReturnProvider() : ?Generator
    {
        $functions = ['end', 'prev', 'next', 'reset', 'current'];
        foreach ($functions as $function) {
            (yield $function => [PhpStormStubsSingleton::getPhpStormStubs()->getFunction($function)]);
        }
    }
    public function expectedFunctionsMixedNullReturnProvider() : ?Generator
    {
        $functions = ['array_pop', 'array_shift'];
        foreach ($functions as $function) {
            (yield $function => [PhpStormStubsSingleton::getPhpStormStubs()->getFunction($function)]);
        }
    }
}
