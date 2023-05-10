<?php

declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\StubTests\TestData\Providers\Reflection;

use Generator;
use _PhpScoper6af4d594edb1\StubTests\Model\PHPClass;
use _PhpScoper6af4d594edb1\StubTests\Model\StubProblemType;
use _PhpScoper6af4d594edb1\StubTests\TestData\Providers\EntitiesFilter;
use _PhpScoper6af4d594edb1\StubTests\TestData\Providers\ReflectionStubsSingleton;
class ReflectionClassesTestDataProviders
{
    public static function allClassesProvider() : ?Generator
    {
        $allClassesAndInterfaces = ReflectionStubsSingleton::getReflectionStubs()->getClasses() + ReflectionStubsSingleton::getReflectionStubs()->getInterfaces();
        foreach (EntitiesFilter::getFiltered($allClassesAndInterfaces) as $class) {
            //exclude classes from PHPReflectionParser
            if (\strncmp($class->name, 'PHP', 3) !== 0) {
                (yield "class {$class->name}" => [$class]);
            }
        }
    }
    public static function classesWithInterfacesProvider() : ?Generator
    {
        foreach (EntitiesFilter::getFiltered(ReflectionStubsSingleton::getReflectionStubs()->getClasses(), fn(PHPClass $class) => empty($class->interfaces), StubProblemType::WRONG_INTERFACE) as $class) {
            //exclude classes from PHPReflectionParser
            if (\strncmp($class->name, 'PHP', 3) !== 0) {
                (yield "class {$class->name}" => [$class]);
            }
        }
    }
    public static function classWithParentProvider() : ?Generator
    {
        $classesAndInterfaces = ReflectionStubsSingleton::getReflectionStubs()->getClasses() + ReflectionStubsSingleton::getReflectionStubs()->getInterfaces();
        $filtered = EntitiesFilter::getFiltered($classesAndInterfaces, fn($class) => empty($class->parentInterfaces) && empty($class->parentClass), StubProblemType::WRONG_PARENT);
        foreach ($filtered as $class) {
            (yield "class {$class->name}" => [$class]);
        }
    }
    public static function finalClassesProvider() : ?Generator
    {
        $classesAndInterfaces = ReflectionStubsSingleton::getReflectionStubs()->getClasses() + ReflectionStubsSingleton::getReflectionStubs()->getInterfaces();
        $filtered = EntitiesFilter::getFiltered($classesAndInterfaces, null, StubProblemType::WRONG_FINAL_MODIFIER);
        foreach ($filtered as $class) {
            (yield "class {$class->name}" => [$class]);
        }
    }
    public static function readonlyClassesProvider() : ?Generator
    {
        $classes = ReflectionStubsSingleton::getReflectionStubs()->getClasses();
        $filtered = EntitiesFilter::getFiltered($classes, fn(PhpClass $class) => $class->isReadonly === \false, StubProblemType::WRONG_READONLY);
        foreach ($filtered as $class) {
            (yield "class {$class->name}" => [$class]);
        }
    }
}
