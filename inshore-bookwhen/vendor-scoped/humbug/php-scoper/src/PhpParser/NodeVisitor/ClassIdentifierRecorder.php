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

use _PhpScoper6af4d594edb1\Humbug\PhpScoper\PhpParser\Node\FullyQualifiedFactory;
use _PhpScoper6af4d594edb1\Humbug\PhpScoper\PhpParser\NodeVisitor\AttributeAppender\ParentNodeAppender;
use _PhpScoper6af4d594edb1\Humbug\PhpScoper\PhpParser\NodeVisitor\Resolver\IdentifierResolver;
use _PhpScoper6af4d594edb1\Humbug\PhpScoper\PhpParser\UnexpectedParsingScenario;
use _PhpScoper6af4d594edb1\Humbug\PhpScoper\Symbol\EnrichedReflector;
use _PhpScoper6af4d594edb1\Humbug\PhpScoper\Symbol\SymbolsRegistry;
use _PhpScoper6af4d594edb1\PhpParser\Node;
use _PhpScoper6af4d594edb1\PhpParser\Node\Identifier;
use _PhpScoper6af4d594edb1\PhpParser\Node\Name\FullyQualified;
use _PhpScoper6af4d594edb1\PhpParser\Node\Stmt\Class_;
use _PhpScoper6af4d594edb1\PhpParser\Node\Stmt\Interface_;
use _PhpScoper6af4d594edb1\PhpParser\NodeVisitorAbstract;
/**
 * Records the classes that need to be aliased.
 *
 * @private
 */
final class ClassIdentifierRecorder extends NodeVisitorAbstract
{
    public function __construct(private readonly string $prefix, private readonly IdentifierResolver $identifierResolver, private readonly SymbolsRegistry $symbolsRegistry, private readonly EnrichedReflector $enrichedReflector)
    {
    }
    public function enterNode(Node $node) : Node
    {
        if (!$node instanceof Identifier || !ParentNodeAppender::hasParent($node)) {
            return $node;
        }
        $parent = ParentNodeAppender::getParent($node);
        $isClassOrInterface = $parent instanceof Class_ || $parent instanceof Interface_;
        if (!$isClassOrInterface) {
            return $node;
        }
        if (null === $parent->name) {
            throw UnexpectedParsingScenario::create();
        }
        $resolvedName = $this->identifierResolver->resolveIdentifier($node);
        if (!$resolvedName instanceof FullyQualified) {
            throw UnexpectedParsingScenario::create();
        }
        if ($this->shouldBeAliased($resolvedName->toString())) {
            $this->symbolsRegistry->recordClass($resolvedName, FullyQualifiedFactory::concat($this->prefix, $resolvedName));
        }
        return $node;
    }
    private function shouldBeAliased(string $resolvedName) : bool
    {
        if ($this->enrichedReflector->isExposedClass($resolvedName)) {
            return \true;
        }
        // Excluded global classes (for which we found a declaration) need to be
        // aliased since otherwise any usage will not point to the prefixed
        // version (since it's an alias) but the declaration will now declare
        // a prefixed version (due to the namespace).
        return $this->enrichedReflector->belongsToGlobalNamespace($resolvedName) && $this->enrichedReflector->isClassExcluded($resolvedName);
    }
}
