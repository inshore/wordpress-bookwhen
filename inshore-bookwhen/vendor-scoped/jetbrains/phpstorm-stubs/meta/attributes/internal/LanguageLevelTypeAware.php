<?php

namespace _PhpScoper6af4d594edb1\JetBrains\PhpStorm\Internal;

use Attribute;
/**
 * For PhpStorm internal use only
 * @since 8.0
 * @internal
 */
#[Attribute(Attribute::TARGET_FUNCTION | Attribute::TARGET_METHOD | Attribute::TARGET_PARAMETER | Attribute::TARGET_PROPERTY)]
class LanguageLevelTypeAware
{
    public function __construct(array $languageLevelTypeMap, string $default)
    {
    }
}
