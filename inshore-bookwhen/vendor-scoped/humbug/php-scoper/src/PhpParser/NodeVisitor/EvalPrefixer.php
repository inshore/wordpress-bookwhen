<?php

declare (strict_types=1);
/*
 * This file is part of the humbug/php-scoper package.
 *
 * Copyright (c) 2017 Théo FIDRY <theo.fidry@gmail.com>,
 *                    Pádraic Brady <padraic.brady@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper6af4d594edb1\Humbug\PhpScoper\PhpParser\NodeVisitor;

use _PhpScoper6af4d594edb1\Humbug\PhpScoper\PhpParser\NodeVisitor\AttributeAppender\ParentNodeAppender;
use _PhpScoper6af4d594edb1\Humbug\PhpScoper\PhpParser\StringNodePrefixer;
use _PhpScoper6af4d594edb1\PhpParser\Node;
use _PhpScoper6af4d594edb1\PhpParser\Node\Expr\Eval_;
use _PhpScoper6af4d594edb1\PhpParser\Node\Scalar\String_;
use _PhpScoper6af4d594edb1\PhpParser\NodeVisitorAbstract;
final class EvalPrefixer extends NodeVisitorAbstract
{
    public function __construct(private readonly StringNodePrefixer $stringPrefixer)
    {
    }
    public function enterNode(Node $node) : Node
    {
        if ($node instanceof String_ && ParentNodeAppender::findParent($node) instanceof Eval_) {
            $this->stringPrefixer->prefixStringValue($node);
        }
        return $node;
    }
}
