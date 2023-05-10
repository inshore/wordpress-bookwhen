<?php

declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\PhpParser\Node\Stmt;

use _PhpScoper6af4d594edb1\PhpParser\Node;
abstract class TraitUseAdaptation extends Node\Stmt
{
    /** @var Node\Name|null Trait name */
    public $trait;
    /** @var Node\Identifier Method name */
    public $method;
}
