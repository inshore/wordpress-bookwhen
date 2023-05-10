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
 * @implements ScalarType<positive-int>
 */
final class PositiveIntegerType implements ScalarType
{
    public function coerceValue($value, string $label) : int
    {
        $intValue = (new NaturalType())->coerceValue($value, $label);
        /** @psalm-suppress MissingClosureReturnType */
        InputAssert::castThrowException(static fn() => Assert::positiveInteger($intValue), $label);
        return $intValue;
    }
    public function getTypeClassNames() : array
    {
        return [self::class];
    }
    public function getPsalmTypeDeclaration() : string
    {
        return 'positive-int';
    }
    public function getPhpTypeDeclaration() : ?string
    {
        return 'int';
    }
}
