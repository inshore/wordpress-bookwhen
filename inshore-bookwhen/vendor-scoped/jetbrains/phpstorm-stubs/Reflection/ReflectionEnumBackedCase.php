<?php

namespace _PhpScoper6af4d594edb1;

/**
 * @link https://php.net/manual/en/class.reflectionenumbackedcase.php
 * @since 8.1
 */
class ReflectionEnumBackedCase extends \ReflectionEnumUnitCase
{
    public function __construct(object|string $class, string $constant)
    {
    }
    #[Pure]
    public function getBackingValue() : int|string
    {
    }
}
/**
 * @link https://php.net/manual/en/class.reflectionenumbackedcase.php
 * @since 8.1
 */
\class_alias('_PhpScoper6af4d594edb1\\ReflectionEnumBackedCase', 'ReflectionEnumBackedCase', \false);
