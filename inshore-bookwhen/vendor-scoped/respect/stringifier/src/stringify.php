<?php

/*
 * This file is part of Respect/Stringifier.
 *
 * (c) Henrique Moody <henriquemoody@gmail.com>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */
declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\Respect\Stringifier;

use _PhpScoper6af4d594edb1\Respect\Stringifier\Stringifiers\ClusterStringifier;
function stringify($value) : string
{
    static $stringifier;
    if (null === $stringifier) {
        $stringifier = ClusterStringifier::createDefault();
    }
    return $stringifier->stringify($value, 0) ?? '#ERROR#';
}
