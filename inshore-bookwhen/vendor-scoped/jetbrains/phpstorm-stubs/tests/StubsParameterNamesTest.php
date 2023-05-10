<?php

declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\StubTests;

use _PhpScoper6af4d594edb1\JetBrains\PhpStorm\Pure;
use RuntimeException;
use _PhpScoper6af4d594edb1\StubTests\Model\PHPClass;
use _PhpScoper6af4d594edb1\StubTests\Model\PHPFunction;
use _PhpScoper6af4d594edb1\StubTests\Model\PHPInterface;
use _PhpScoper6af4d594edb1\StubTests\Model\PHPMethod;
use _PhpScoper6af4d594edb1\StubTests\Model\PHPParameter;
use _PhpScoper6af4d594edb1\StubTests\TestData\Providers\PhpStormStubsSingleton;
class StubsParameterNamesTest extends AbstractBaseStubsTestCase
{
    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionParametersProvider::functionParametersProvider
     * @throws RuntimeException
     */
    public function testFunctionsParameterNames(PHPFunction $function, PHPParameter $parameter)
    {
        $phpstormFunction = PhpStormStubsSingleton::getPhpStormStubs()->getFunction($function->name);
        self::assertNotEmpty(\array_filter($phpstormFunction->parameters, fn(PHPParameter $stubParameter) => $stubParameter->name === $parameter->name), "Function {$function->name} has signature {$function->name}(" . self::printParameters($function->parameters) . ')' . " but stub function has signature {$phpstormFunction->name}(" . self::printParameters($phpstormFunction->parameters) . ')');
    }
    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionParametersProvider::methodParametersProvider
     * @throws RuntimeException
     */
    public function testMethodsParameterNames(PHPClass|PHPInterface $reflectionClass, PHPMethod $reflectionMethod, PHPParameter $reflectionParameter)
    {
        $className = $reflectionClass->name;
        $methodName = $reflectionMethod->name;
        if ($reflectionClass instanceof PHPClass) {
            $stubMethod = PhpStormStubsSingleton::getPhpStormStubs()->getClass($className)->getMethod($methodName);
        } else {
            $stubMethod = PhpStormStubsSingleton::getPhpStormStubs()->getInterface($className)->getMethod($methodName);
        }
        self::assertNotEmpty(\array_filter($stubMethod->parameters, fn(PHPParameter $stubParameter) => $stubParameter->name === $reflectionParameter->name), "Method {$className}::{$methodName} has signature {$methodName}(" . self::printParameters($reflectionMethod->parameters) . ')' . " but stub function has signature {$methodName}(" . self::printParameters($stubMethod->parameters) . ')');
    }
    /**
     * @param PHPParameter[] $params
     */
    #[Pure]
    public static function printParameters(array $params) : string
    {
        $signature = '';
        foreach ($params as $param) {
            $signature .= '$' . $param->name . ', ';
        }
        return \trim($signature, ', ');
    }
}
