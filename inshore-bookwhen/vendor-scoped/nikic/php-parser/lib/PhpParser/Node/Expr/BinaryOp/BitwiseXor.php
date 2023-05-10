<?php

declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\PhpParser\Node\Expr\BinaryOp;

use _PhpScoper6af4d594edb1\PhpParser\Node\Expr\BinaryOp;
class BitwiseXor extends BinaryOp
{
    public function getOperatorSigil() : string
    {
        return '^';
    }
    public function getType() : string
    {
        return 'Expr_BinaryOp_BitwiseXor';
    }
}
