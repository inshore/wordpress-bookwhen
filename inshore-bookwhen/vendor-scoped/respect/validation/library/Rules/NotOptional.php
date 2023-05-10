<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */
declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\Respect\Validation\Rules;

use _PhpScoper6af4d594edb1\Respect\Validation\Helpers\CanValidateUndefined;
/**
 * Validates if the given input is not optional.
 *
 * By optional we consider null or an empty string ('').
 *
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class NotOptional extends AbstractRule
{
    use CanValidateUndefined;
    /**
     * {@inheritDoc}
     */
    public function validate($input) : bool
    {
        return $this->isUndefined($input) === \false;
    }
}
