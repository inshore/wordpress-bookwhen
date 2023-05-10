<?php

declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\PhpParser\Lexer\TokenEmulator;

use _PhpScoper6af4d594edb1\PhpParser\Lexer\Emulative;
final class MatchTokenEmulator extends KeywordEmulator
{
    public function getPhpVersion() : string
    {
        return Emulative::PHP_8_0;
    }
    public function getKeywordString() : string
    {
        return 'match';
    }
    public function getKeywordToken() : int
    {
        return \T_MATCH;
    }
}
