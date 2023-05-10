<?php

declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\PhpParser;

/**
 * @codeCoverageIgnore
 */
class NodeVisitorAbstract implements NodeVisitor
{
    public function beforeTraverse(array $nodes)
    {
        return null;
    }
    public function enterNode(Node $node)
    {
        return null;
    }
    public function leaveNode(Node $node)
    {
        return null;
    }
    public function afterTraverse(array $nodes)
    {
        return null;
    }
}
