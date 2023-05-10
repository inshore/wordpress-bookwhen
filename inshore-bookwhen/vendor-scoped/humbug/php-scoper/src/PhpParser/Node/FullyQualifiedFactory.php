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
namespace _PhpScoper6af4d594edb1\Humbug\PhpScoper\PhpParser\Node;

use _PhpScoper6af4d594edb1\Humbug\PhpScoper\NotInstantiable;
use InvalidArgumentException;
use _PhpScoper6af4d594edb1\PhpParser\Node\Name;
use _PhpScoper6af4d594edb1\PhpParser\Node\Name\FullyQualified;
final class FullyQualifiedFactory
{
    use NotInstantiable;
    /**
     * @param string|string[]|Name|null $name1
     * @param string|string[]|Name|null $name2
     */
    public static function concat($name1, $name2, array $attributes = []) : FullyQualified
    {
        if (null === $name1 && null === $name2) {
            throw new InvalidArgumentException('Expected one of the names to not be null');
        }
        return FullyQualified::concat($name1, $name2, $attributes);
    }
}
