<?php

declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\PhpParser;

interface Builder
{
    /**
     * Returns the built node.
     *
     * @return Node The built node
     */
    public function getNode() : Node;
}
