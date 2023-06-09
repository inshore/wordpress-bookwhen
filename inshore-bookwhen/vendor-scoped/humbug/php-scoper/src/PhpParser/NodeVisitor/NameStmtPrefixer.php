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
use _PhpScoper6af4d594edb1\Humbug\PhpScoper\PhpParser\NodeVisitor\NamespaceStmt\NamespaceStmtCollection;
use _PhpScoper6af4d594edb1\Humbug\PhpScoper\PhpParser\NodeVisitor\Resolver\OriginalNameResolver;
use _PhpScoper6af4d594edb1\Humbug\PhpScoper\PhpParser\NodeVisitor\UseStmt\UseStmtCollection;
use _PhpScoper6af4d594edb1\Humbug\PhpScoper\PhpParser\UseStmtName;
use _PhpScoper6af4d594edb1\Humbug\PhpScoper\Symbol\EnrichedReflector;
use _PhpScoper6af4d594edb1\PhpParser\Node;
use _PhpScoper6af4d594edb1\PhpParser\Node\Attribute;
use _PhpScoper6af4d594edb1\PhpParser\Node\Expr\ArrowFunction;
use _PhpScoper6af4d594edb1\PhpParser\Node\Expr\ClassConstFetch;
use _PhpScoper6af4d594edb1\PhpParser\Node\Expr\Closure;
use _PhpScoper6af4d594edb1\PhpParser\Node\Expr\ConstFetch;
use _PhpScoper6af4d594edb1\PhpParser\Node\Expr\FuncCall;
use _PhpScoper6af4d594edb1\PhpParser\Node\Expr\Instanceof_;
use _PhpScoper6af4d594edb1\PhpParser\Node\Expr\New_;
use _PhpScoper6af4d594edb1\PhpParser\Node\Expr\StaticCall;
use _PhpScoper6af4d594edb1\PhpParser\Node\Expr\StaticPropertyFetch;
use _PhpScoper6af4d594edb1\PhpParser\Node\IntersectionType;
use _PhpScoper6af4d594edb1\PhpParser\Node\Name;
use _PhpScoper6af4d594edb1\PhpParser\Node\Name\FullyQualified;
use _PhpScoper6af4d594edb1\PhpParser\Node\NullableType;
use _PhpScoper6af4d594edb1\PhpParser\Node\Param;
use _PhpScoper6af4d594edb1\PhpParser\Node\Stmt\Catch_;
use _PhpScoper6af4d594edb1\PhpParser\Node\Stmt\Class_;
use _PhpScoper6af4d594edb1\PhpParser\Node\Stmt\ClassMethod;
use _PhpScoper6af4d594edb1\PhpParser\Node\Stmt\Function_;
use _PhpScoper6af4d594edb1\PhpParser\Node\Stmt\Interface_;
use _PhpScoper6af4d594edb1\PhpParser\Node\Stmt\Property;
use _PhpScoper6af4d594edb1\PhpParser\Node\Stmt\TraitUse;
use _PhpScoper6af4d594edb1\PhpParser\Node\Stmt\TraitUseAdaptation\Alias;
use _PhpScoper6af4d594edb1\PhpParser\Node\Stmt\TraitUseAdaptation\Precedence;
use _PhpScoper6af4d594edb1\PhpParser\Node\Stmt\Use_;
use _PhpScoper6af4d594edb1\PhpParser\Node\UnionType;
use _PhpScoper6af4d594edb1\PhpParser\NodeVisitorAbstract;
use function in_array;
use function strtolower;
/**
 * Prefixes names when appropriate.
 *
 * ```
 * new Foo\Bar();
 * ```.
 *
 * =>
 *
 * ```
 * new \Humbug\Foo\Bar();
 * ```
 *
 * @private
 */
final class NameStmtPrefixer extends NodeVisitorAbstract
{
    private const SUPPORTED_PARENT_NODE_CLASS_NAMES = [Alias::class, Attribute::class, ArrowFunction::class, Catch_::class, ConstFetch::class, Class_::class, ClassConstFetch::class, ClassMethod::class, Closure::class, FuncCall::class, Function_::class, Instanceof_::class, Interface_::class, New_::class, Param::class, Precedence::class, Property::class, StaticCall::class, StaticPropertyFetch::class, TraitUse::class, UnionType::class, IntersectionType::class];
    public function __construct(private readonly string $prefix, private readonly NamespaceStmtCollection $namespaceStatements, private readonly UseStmtCollection $useStatements, private readonly EnrichedReflector $enrichedReflector)
    {
    }
    public function enterNode(Node $node) : Node
    {
        if (!$node instanceof Name) {
            return $node;
        }
        return $this->prefixName($node, self::getParent($node));
    }
    private static function getParent(Node $name) : Node
    {
        $parent = ParentNodeAppender::getParent($name);
        // The parent can be a nullable type. For example for "public ?Foo $x"
        // the parent of Name("Foo") will be NullableType.
        // In practice, we do not get any information from NullableType to
        // determine if we can prefix or not our name hence we skip it completely
        if (!$parent instanceof NullableType) {
            return $parent;
        }
        return self::getParent($parent);
    }
    private function prefixName(Name $resolvedName, Node $parentNode) : Node
    {
        if ($resolvedName->isSpecialClassName() || !self::isParentNodeSupported($parentNode)) {
            return $resolvedName;
        }
        $originalName = OriginalNameResolver::getOriginalName($resolvedName);
        // Happens when assigning `null` as a default value for example
        if ($parentNode instanceof ConstFetch && 'null' === $originalName->toLowerString()) {
            return $originalName;
        }
        $useStatement = $this->useStatements->findStatementForNode($this->namespaceStatements->findNamespaceForNode($resolvedName), $resolvedName);
        if ($this->doesNameHasUseStatement($originalName, $resolvedName, $parentNode, $useStatement)) {
            // Do not prefix if there is a matching use statement.
            return $originalName;
        }
        if ($this->isNamePrefixable($resolvedName)) {
            return $resolvedName;
        }
        // Do not prefix if the Name is inside the current namespace
        $currentNamespace = $this->namespaceStatements->getCurrentNamespaceName();
        if (self::doesNameBelongToNamespace($originalName, $resolvedName, $currentNamespace) || $this->doesNameBelongToGlobalNamespace($originalName, $resolvedName->toString(), $parentNode, $currentNamespace)) {
            return $originalName;
        }
        if (!$this->isPrefixableClassName($resolvedName, $parentNode)) {
            return $resolvedName;
        }
        if ($parentNode instanceof ConstFetch) {
            $prefixedName = $this->prefixConstFetchNode($resolvedName);
            if (null !== $prefixedName) {
                return $prefixedName;
            }
            // Continue
        }
        if ($parentNode instanceof FuncCall) {
            $prefixedName = $this->prefixFuncCallNode($originalName, $resolvedName);
            if (null !== $prefixedName) {
                return $prefixedName;
            }
            // Continue
        }
        return FullyQualifiedFactory::concat($this->prefix, $resolvedName->toString(), $resolvedName->getAttributes());
    }
    private static function isParentNodeSupported(Node $parentNode) : bool
    {
        foreach (self::SUPPORTED_PARENT_NODE_CLASS_NAMES as $supportedClassName) {
            if ($parentNode instanceof $supportedClassName) {
                return \true;
            }
        }
        return \false;
    }
    private function isNamePrefixable(Name $resolvedName) : bool
    {
        if (!$resolvedName->isFullyQualified()) {
            return \false;
        }
        $isAlreadyPrefixed = $this->prefix === $resolvedName->getFirst();
        return $isAlreadyPrefixed || $this->enrichedReflector->belongsToExcludedNamespace((string) $resolvedName);
    }
    private static function doesNameBelongToNamespace(Name $originalName, Name $resolvedName, ?Name $namespaceName) : bool
    {
        if ($namespaceName === null || !$resolvedName->isFullyQualified() || $originalName->isFullyQualified()) {
            return \false;
        }
        $originalNameFQParts = [...$namespaceName->parts, ...$originalName->parts];
        return $originalNameFQParts === $resolvedName->parts;
    }
    private function doesNameBelongToGlobalNamespace(Name $originalName, string $resolvedName, Node $parentNode, ?Name $namespaceName) : bool
    {
        return null === $namespaceName && !$originalName->isFullyQualified() && !$parentNode instanceof ConstFetch && (!$this->enrichedReflector->isExposedClass($resolvedName) || $this->enrichedReflector->isExposedClassFromGlobalNamespace($resolvedName)) && !$this->enrichedReflector->isClassExcluded($resolvedName) && (!$this->enrichedReflector->isExposedFunction($resolvedName) || $this->enrichedReflector->isExposedFunctionFromGlobalNamespace($resolvedName)) && !$this->enrichedReflector->isFunctionExcluded($resolvedName);
    }
    private function doesNameHasUseStatement(Name $originalName, Name $resolvedName, Node $parentNode, ?Name $useStatementName) : bool
    {
        if (null === $useStatementName || !$resolvedName->isFullyQualified() || $originalName->isFullyQualified()) {
            return \false;
        }
        $useStmt = new UseStmtName($useStatementName);
        if (!$useStmt->contains($resolvedName)) {
            return \false;
        }
        [$useStmtAlias, $useStmtType] = $useStmt->getUseStmtAliasAndType();
        if ($parentNode instanceof ConstFetch) {
            $isExposedConstant = $this->enrichedReflector->isExposedConstant($resolvedName->toString());
            // If a constant is exposed, it can be that letting a non FQ breaks
            // things. For example the exposed namespaced constant could be
            // used via a partial import (in which case it is a regular import not
            // a constant one) which may not be prefixed.
            return $isExposedConstant && Use_::TYPE_CONSTANT === $useStmtType || !$isExposedConstant;
        }
        if (null === $useStmtAlias) {
            return \true;
        }
        // Classes and namespaces usages are case-insensitive
        $caseSensitiveUseStmt = !in_array($useStmtType, [Use_::TYPE_UNKNOWN, Use_::TYPE_NORMAL], \true);
        return $caseSensitiveUseStmt ? $originalName->getFirst() === $useStmtAlias : strtolower($originalName->getFirst()) === strtolower($useStmtAlias);
    }
    private function isPrefixableClassName(Name $resolvedName, Node $parentNode) : bool
    {
        $isClassNode = $parentNode instanceof ConstFetch || $parentNode instanceof FuncCall;
        return $isClassNode || !$resolvedName->isFullyQualified() || !$this->enrichedReflector->isClassExcluded($resolvedName->toString());
    }
    /**
     * @return Name|null Returns the name to use (prefixed or not). Otherwise
     *                   it was not possible to resolve the name and the name
     *                   will end up being prefixed the "regular" way (prefix
     *                   added)
     */
    private function prefixConstFetchNode(Name $resolvedName) : ?Name
    {
        $resolvedNameString = $resolvedName->toString();
        if ($resolvedName->isFullyQualified()) {
            return $this->enrichedReflector->isExposedConstant($resolvedNameString) ? $resolvedName : null;
        }
        // Constants have an auto-loading fallback, so as a rule we cannot
        // prefix them when the name is ambiguous.
        // See https://wiki.php.net/rfc/fallback-to-root-scope-deprecation
        //
        // HOWEVER. However. There is _very_ high chances that if a user
        // explicitly register a constant to be exposed or that the constant
        // is internal that it is the constant in question and not the one
        // relative to the namespace.
        // Indeed it would otherwise mean that the user has for example Acme\FOO
        // and \FOO in the codebase AND decide to expose \FOO.
        // It is not only unlikely but sketchy, hence should not be an issue
        // in practice.
        // We distinguish exposed from internal here as internal are a much safer
        // bet.
        if ($this->enrichedReflector->isConstantInternal($resolvedNameString)) {
            return new FullyQualified($resolvedNameString, $resolvedName->getAttributes());
        }
        if ($this->enrichedReflector->isExposedConstant($resolvedNameString)) {
            return $this->enrichedReflector->isExposedConstantFromGlobalNamespace($resolvedNameString) ? $resolvedName : new FullyQualified($resolvedNameString, $resolvedName->getAttributes());
        }
        return $resolvedName;
    }
    /**
     * @return Name|null Returns the name to use (prefixed or not). Otherwise
     *                   it was not possible to resolve the name and the name
     *                   will end up being prefixed the "regular" way (prefix
     *                   added)
     */
    private function prefixFuncCallNode(Name $originalName, Name $resolvedName) : ?Name
    {
        // Functions have a fallback auto-loading so we cannot prefix them when
        // the name is ambiguous
        // See https://wiki.php.net/rfc/fallback-to-root-scope-deprecation
        //
        // See prefixConstFetchNode() for more details as to why we can still
        // take the risk under some circumstances.
        $resolvedNameString = $resolvedName->toString();
        if ($resolvedName->isFullyQualified()) {
            return $this->enrichedReflector->isFunctionExcluded($resolvedNameString) ? $resolvedName : null;
        }
        if ($this->enrichedReflector->isFunctionInternal($resolvedNameString)) {
            return new FullyQualified($originalName->toString(), $originalName->getAttributes());
        }
        if ($this->enrichedReflector->isExposedFunction($resolvedNameString)) {
            return $this->enrichedReflector->isExposedFunctionFromGlobalNamespace($resolvedNameString) ? $resolvedName : null;
        }
        return $resolvedName;
    }
}
