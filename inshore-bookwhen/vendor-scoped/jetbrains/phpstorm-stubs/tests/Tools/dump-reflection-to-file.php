<?php

namespace _PhpScoper6af4d594edb1\StubTests\Tools;

require_once 'ModelAutoloader.php';
ModelAutoloader::register();
use _PhpScoper6af4d594edb1\StubTests\TestData\Providers\ReflectionStubsSingleton;
$reflectionFileName = $argv[1];
\file_put_contents(__DIR__ . "/../../{$reflectionFileName}", \serialize(ReflectionStubsSingleton::getReflectionStubs()));
