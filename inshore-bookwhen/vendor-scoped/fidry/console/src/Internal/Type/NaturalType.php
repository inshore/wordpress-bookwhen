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
namespace _PhpScoper6af4d594edb1\Fidry\Console\Internal\Type;

use _PhpScoper6af4d594edb1\Fidry\Console\InputAssert;
use _PhpScoper6af4d594edb1\Webmozart\Assert\Assert;
/**
 * There cannot be negative integers with the Symfony console.
 *
 * @see https://github.com/symfony/symfony/issues/27333
 *
 * @implements ScalarType<positive-int|0>
 */
final class NaturalType implements ScalarType
{
    public function coerceValue($value, string $label) : int
    {
        InputAssert::integerString($value, $label);
        $intValue = (int) $value;
        /** @psalm-suppress InvalidDocblock,MissingClosureReturnType */
        InputAssert::castThrowException(static fn() => Assert::natural($intValue), $label);
        return (int) $value;
    }
    public function getTypeClassNames() : array
    {
        return [self::class];
    }
    public function getPsalmTypeDeclaration() : string
    {
        return 'positive-int|0';
    }
    public function getPhpTypeDeclaration() : ?string
    {
        return 'int';
    }
}
