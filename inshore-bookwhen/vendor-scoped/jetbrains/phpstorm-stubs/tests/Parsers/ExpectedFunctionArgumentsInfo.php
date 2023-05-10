<?php

declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\StubTests\Parsers;

use _PhpScoper6af4d594edb1\JetBrains\PhpStorm\Pure;
use _PhpScoper6af4d594edb1\PhpParser\Node\Expr;
class ExpectedFunctionArgumentsInfo
{
    /**
     * ExpectedFunctionArgumentsInfo constructor.
     * @param Expr|null $functionReference
     * @param Expr[] $expectedArguments
     * @param int $index
     */
    public function __construct(private ?Expr $functionReference, private array $expectedArguments, private int $index)
    {
    }
    public function getFunctionReference() : ?Expr
    {
        return $this->functionReference;
    }
    public function setFunctionReference(Expr $functionReference) : void
    {
        $this->functionReference = $functionReference;
    }
    /**
     * @return Expr[]
     */
    public function getExpectedArguments() : array
    {
        return $this->expectedArguments;
    }
    /**
     * @param Expr[] $expectedArguments
     */
    public function setExpectedArguments(array $expectedArguments) : void
    {
        $this->expectedArguments = $expectedArguments;
    }
    public function getIndex() : int
    {
        return $this->index;
    }
    #[Pure]
    public function __toString() : string
    {
        if ($this->functionReference === null) {
            return '';
        }
        if (\property_exists($this->functionReference, 'name')) {
            return (string) $this->functionReference->name;
        }
        return \implode(',', $this->functionReference->getAttributes());
    }
}
