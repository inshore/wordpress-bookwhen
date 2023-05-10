<?php

declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\StubTests\TestData\Providers\Reflection;

use Generator;
use _PhpScoper6af4d594edb1\StubTests\Model\PHPProperty;
use _PhpScoper6af4d594edb1\StubTests\Model\StubProblemType;
use _PhpScoper6af4d594edb1\StubTests\TestData\Providers\EntitiesFilter;
use _PhpScoper6af4d594edb1\StubTests\TestData\Providers\ReflectionStubsSingleton;
class ReflectionPropertiesProvider
{
    public static function classPropertiesProvider() : Generator
    {
        return self::yieldFilteredMethodProperties();
    }
    public static function classStaticPropertiesProvider() : Generator
    {
        return self::yieldFilteredMethodProperties(StubProblemType::PROPERTY_IS_STATIC);
    }
    public static function classPropertiesWithAccessProvider() : Generator
    {
        return self::yieldFilteredMethodProperties(StubProblemType::PROPERTY_ACCESS);
    }
    public static function classPropertiesWithTypeProvider() : Generator
    {
        return self::yieldFilteredMethodProperties(StubProblemType::PROPERTY_TYPE);
    }
    public static function classReadonlyPropertiesProvider() : Generator
    {
        return self::yieldFilteredMethodProperties(StubProblemType::WRONG_READONLY);
    }
    private static function yieldFilteredMethodProperties(int ...$problemTypes) : ?Generator
    {
        $classesAndInterfaces = ReflectionStubsSingleton::getReflectionStubs()->getClasses();
        foreach (EntitiesFilter::getFiltered($classesAndInterfaces) as $class) {
            foreach (EntitiesFilter::getFiltered($class->properties, fn(PHPProperty $property) => $property->access === 'private', ...$problemTypes) as $property) {
                (yield "Property {$class->name}::{$property->name}" => [$class, $property]);
            }
        }
    }
}
