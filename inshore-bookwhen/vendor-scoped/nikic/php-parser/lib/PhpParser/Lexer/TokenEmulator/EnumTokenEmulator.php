<?php

declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\PhpParser\Lexer\TokenEmulator;

use _PhpScoper6af4d594edb1\PhpParser\Lexer\Emulative;
final class EnumTokenEmulator extends KeywordEmulator
{
    public function getPhpVersion() : string
    {
        return Emulative::PHP_8_1;
    }
    public function getKeywordString() : string
    {
        return 'enum';
    }
    public function getKeywordToken() : int
    {
        return \T_ENUM;
    }
    protected function isKeywordContext(array $tokens, int $pos) : bool
    {
        return parent::isKeywordContext($tokens, $pos) && isset($tokens[$pos + 2]) && $tokens[$pos + 1][0] === \T_WHITESPACE && $tokens[$pos + 2][0] === \T_STRING;
    }
}
