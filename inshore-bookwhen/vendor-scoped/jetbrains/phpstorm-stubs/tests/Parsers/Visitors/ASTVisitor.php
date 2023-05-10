<?php

declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\StubTests\Parsers\Visitors;

use Exception;
use _PhpScoper6af4d594edb1\PhpParser\Node;
use _PhpScoper6af4d594edb1\PhpParser\Node\Const_;
use _PhpScoper6af4d594edb1\PhpParser\Node\Expr\FuncCall;
use _PhpScoper6af4d594edb1\PhpParser\Node\Stmt\Class_;
use _PhpScoper6af4d594edb1\PhpParser\Node\Stmt\ClassMethod;
use _PhpScoper6af4d594edb1\PhpParser\Node\Stmt\Function_;
use _PhpScoper6af4d594edb1\PhpParser\Node\Stmt\Interface_;
use _PhpScoper6af4d594edb1\PhpParser\NodeVisitorAbstract;
use RuntimeException;
use _PhpScoper6af4d594edb1\StubTests\Model\CommonUtils;
use _PhpScoper6af4d594edb1\StubTests\Model\PHPClass;
use _PhpScoper6af4d594edb1\StubTests\Model\PHPConst;
use _PhpScoper6af4d594edb1\StubTests\Model\PHPDefineConstant;
use _PhpScoper6af4d594edb1\StubTests\Model\PHPFunction;
use _PhpScoper6af4d594edb1\StubTests\Model\PHPInterface;
use _PhpScoper6af4d594edb1\StubTests\Model\PHPMethod;
use _PhpScoper6af4d594edb1\StubTests\Model\PHPProperty;
use _PhpScoper6af4d594edb1\StubTests\Model\StubsContainer;
class ASTVisitor extends NodeVisitorAbstract
{
    public function __construct(protected StubsContainer $stubs, protected bool $isStubCore = \false, public ?string $sourceFilePath = null)
    {
    }
    /**
     * @throws Exception
     */
    public function enterNode(Node $node) : void
    {
        if ($node instanceof Function_) {
            $function = (new PHPFunction())->readObjectFromStubNode($node);
            $function->sourceFilePath = $this->sourceFilePath;
            if ($this->isStubCore) {
                $function->stubBelongsToCore = \true;
            }
            $this->stubs->addFunction($function);
        } elseif ($node instanceof Const_) {
            $constant = (new PHPConst())->readObjectFromStubNode($node);
            $constant->sourceFilePath = $this->sourceFilePath;
            if ($this->isStubCore) {
                $constant->stubBelongsToCore = \true;
            }
            if ($constant->parentName === null) {
                $this->stubs->addConstant($constant);
            } elseif ($this->stubs->getClass($constant->parentName, $this->sourceFilePath, \false) !== null) {
                $this->stubs->getClass($constant->parentName, $this->sourceFilePath, \false)->addConstant($constant);
            } elseif ($this->stubs->getInterface($constant->parentName, $this->sourceFilePath, \false) !== null) {
                $this->stubs->getInterface($constant->parentName, $this->sourceFilePath, \false)->addConstant($constant);
            }
        } elseif ($node instanceof FuncCall) {
            if ($node->name->parts[0] === 'define') {
                $constant = (new PHPDefineConstant())->readObjectFromStubNode($node);
                $constant->sourceFilePath = $this->sourceFilePath;
                if ($this->isStubCore) {
                    $constant->stubBelongsToCore = \true;
                }
                $this->stubs->addConstant($constant);
            }
        } elseif ($node instanceof ClassMethod) {
            $method = (new PHPMethod())->readObjectFromStubNode($node);
            $method->sourceFilePath = $this->sourceFilePath;
            if ($this->isStubCore) {
                $method->stubBelongsToCore = \true;
            }
            if ($this->stubs->getClass($method->parentName, $this->sourceFilePath, \false) !== null) {
                $this->stubs->getClass($method->parentName, $this->sourceFilePath, \false)->addMethod($method);
            } elseif ($this->stubs->getInterface($method->parentName, $this->sourceFilePath, \false) !== null) {
                $this->stubs->getInterface($method->parentName, $this->sourceFilePath, \false)->addMethod($method);
            }
        } elseif ($node instanceof Interface_) {
            $interface = (new PHPInterface())->readObjectFromStubNode($node);
            $interface->sourceFilePath = $this->sourceFilePath;
            if ($this->isStubCore) {
                $interface->stubBelongsToCore = \true;
            }
            $this->stubs->addInterface($interface);
        } elseif ($node instanceof Class_) {
            $class = (new PHPClass())->readObjectFromStubNode($node);
            $class->sourceFilePath = $this->sourceFilePath;
            if ($this->isStubCore) {
                $class->stubBelongsToCore = \true;
            }
            $this->stubs->addClass($class);
        } elseif ($node instanceof Node\Stmt\Property) {
            $property = (new PHPProperty())->readObjectFromStubNode($node);
            $property->sourceFilePath = $this->sourceFilePath;
            if ($this->isStubCore) {
                $property->stubBelongsToCore = \true;
            }
            if ($this->stubs->getClass($property->parentName, $this->sourceFilePath, \false) !== null) {
                $this->stubs->getClass($property->parentName, $this->sourceFilePath, \false)->addProperty($property);
            }
        }
    }
    /**
     * @throws RuntimeException
     */
    public function combineParentInterfaces(PHPInterface $interface) : array
    {
        $parents = [];
        if (empty($interface->parentInterfaces)) {
            return $parents;
        }
        /** @var string $parentInterface */
        foreach ($interface->parentInterfaces as $parentInterface) {
            $parents[] = $parentInterface;
            if ($this->stubs->getInterface($parentInterface, $interface->stubBelongsToCore ? null : $interface->sourceFilePath, \false) !== null) {
                foreach ($this->combineParentInterfaces($this->stubs->getInterface($parentInterface, $interface->stubBelongsToCore ? null : $interface->sourceFilePath, \false)) as $value) {
                    $parents[] = $value;
                }
            }
        }
        return $parents;
    }
    /**
     * @throws RuntimeException
     */
    public function combineImplementedInterfaces(PHPClass $class) : array
    {
        $interfaces = [];
        /** @var string $interface */
        foreach ($class->interfaces as $interface) {
            $interfaces[] = $interface;
            if ($this->stubs->getInterface($interface, $class->stubBelongsToCore ? null : $class->sourceFilePath, \false) !== null) {
                $interfaces[] = $this->stubs->getInterface($interface, $class->stubBelongsToCore ? null : $class->sourceFilePath, \false)->parentInterfaces;
            }
        }
        if ($class->parentClass === null) {
            return $interfaces;
        }
        if ($this->stubs->getClass($class->parentClass, $class->stubBelongsToCore ? null : $class->sourceFilePath, \false) !== null) {
            $inherited = $this->combineImplementedInterfaces($this->stubs->getClass($class->parentClass, $class->stubBelongsToCore ? null : $class->sourceFilePath, \false));
            $interfaces[] = CommonUtils::flattenArray($inherited, \false);
        }
        return $interfaces;
    }
}
