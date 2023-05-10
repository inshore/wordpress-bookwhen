<?php

declare (strict_types=1);
/*
 * This file is part of the humbug/php-scoper package.
 *
 * Copyright (c) 2017 Théo FIDRY <theo.fidry@gmail.com>,
 *                    Pádraic Brady <padraic.brady@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper6af4d594edb1\Humbug\PhpScoper\Scoper;

use _PhpScoper6af4d594edb1\Humbug\PhpScoper\Scoper\Symfony\XmlScoper as SymfonyXmlScoper;
use _PhpScoper6af4d594edb1\Humbug\PhpScoper\Scoper\Symfony\YamlScoper as SymfonyYamlScoper;
use _PhpScoper6af4d594edb1\Humbug\PhpScoper\Symbol\EnrichedReflector;
use _PhpScoper6af4d594edb1\Humbug\PhpScoper\Symbol\SymbolsRegistry;
use _PhpScoper6af4d594edb1\PhpParser\Error as PhpParserError;
use function func_get_args;
/**
 * Scopes the Symfony configuration related files.
 */
final class SymfonyScoper implements Scoper
{
    private readonly SymfonyXmlScoper $decoratedScoper;
    public function __construct(Scoper $decoratedScoper, string $prefix, EnrichedReflector $enrichedReflector, SymbolsRegistry $symbolsRegistry)
    {
        $this->decoratedScoper = new SymfonyXmlScoper(new SymfonyYamlScoper($decoratedScoper, $prefix, $enrichedReflector, $symbolsRegistry), $prefix, $enrichedReflector, $symbolsRegistry);
    }
    /**
     * Scopes PHP files.
     *
     * @throws PhpParserError
     */
    public function scope(string $filePath, string $contents) : string
    {
        return $this->decoratedScoper->scope(...func_get_args());
    }
}
