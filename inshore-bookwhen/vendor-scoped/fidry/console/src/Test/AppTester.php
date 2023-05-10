<?php

/*
 * This file is part of the Fidry\Console package.
 *
 * (c) Théo FIDRY <theo.fidry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\Fidry\Console\Test;

use _PhpScoper6af4d594edb1\Fidry\Console\Application\Application as ConsoleApplication;
use _PhpScoper6af4d594edb1\Fidry\Console\Application\SymfonyApplication;
use _PhpScoper6af4d594edb1\Fidry\Console\DisplayNormalizer;
use _PhpScoper6af4d594edb1\Symfony\Component\Console\Tester\ApplicationTester;
/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class AppTester extends ApplicationTester
{
    public static function fromConsoleApp(ConsoleApplication $application) : self
    {
        return new self(new SymfonyApplication($application));
    }
    /**
     * @param callable(string):string $extraNormalizers
     */
    public function getNormalizedDisplay(callable ...$extraNormalizers) : string
    {
        return DisplayNormalizer::removeTrailingSpaces($this->getDisplay(), ...$extraNormalizers);
    }
}
