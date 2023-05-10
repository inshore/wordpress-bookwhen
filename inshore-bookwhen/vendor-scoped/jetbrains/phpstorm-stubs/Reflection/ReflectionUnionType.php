<?php

namespace _PhpScoper6af4d594edb1;

use _PhpScoper6af4d594edb1\JetBrains\PhpStorm\Pure;
/**
 * @since 8.0
 */
class ReflectionUnionType extends \ReflectionType
{
    /**
     * Get list of named types of union type
     *
     * @return ReflectionNamedType[]
     */
    #[Pure]
    public function getTypes() : array
    {
    }
}
/**
 * @since 8.0
 */
\class_alias('_PhpScoper6af4d594edb1\\ReflectionUnionType', 'ReflectionUnionType', \false);
