<?php

namespace _PhpScoper6af4d594edb1\StubTests\Model;

use RecursiveArrayIterator;
use RecursiveIteratorIterator;
class CommonUtils
{
    /**
     * @param array $array
     * @param bool $group
     * @return array
     */
    public static function flattenArray(array $array, $group)
    {
        return \iterator_to_array(new RecursiveIteratorIterator(new RecursiveArrayIterator($array)), $group);
    }
}
