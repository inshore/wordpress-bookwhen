<?php

declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\StubTests\Parsers\Visitors;

use _PhpScoper6af4d594edb1\JetBrains\PhpStorm\Pure;
use _PhpScoper6af4d594edb1\StubTests\Model\StubsContainer;
class CoreStubASTVisitor extends ASTVisitor
{
    #[Pure]
    public function __construct(StubsContainer $stubs)
    {
        parent::__construct($stubs);
        $this->isStubCore = \true;
    }
}
