<?php

declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\StubTests\Parsers\Visitors;

use _PhpScoper6af4d594edb1\PhpParser\Node;
use _PhpScoper6af4d594edb1\PhpParser\NodeVisitorAbstract;
use function count;
/**
 * The visitor is required to provide "parent" attribute to nodes
 */
class ParentConnector extends NodeVisitorAbstract
{
    /**
     * @var Node[]
     */
    private array $stack;
    public function beforeTraverse(array $nodes) : void
    {
        $this->stack = [];
    }
    public function enterNode(Node $node) : void
    {
        if (!empty($this->stack)) {
            $node->setAttribute('parent', $this->stack[count($this->stack) - 1]);
        }
        $this->stack[] = $node;
    }
    public function leaveNode(Node $node) : void
    {
        \array_pop($this->stack);
    }
}
