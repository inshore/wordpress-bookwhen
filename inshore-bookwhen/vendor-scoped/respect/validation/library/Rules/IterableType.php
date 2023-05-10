<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */
declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\Respect\Validation\Rules;

use _PhpScoper6af4d594edb1\Respect\Validation\Helpers\CanValidateIterable;
/**
 * Validates whether the pseudo-type of the input is iterable or not.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class IterableType extends AbstractRule
{
    use CanValidateIterable;
    /**
     * {@inheritDoc}
     */
    public function validate($input) : bool
    {
        return $this->isIterable($input);
    }
}
