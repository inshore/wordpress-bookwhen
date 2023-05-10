<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */
declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\Respect\Validation\Rules;

/**
 * Validates if the input is identical to some value.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Identical extends AbstractRule
{
    /**
     * @var mixed
     */
    private $compareTo;
    /**
     * Initializes the rule.
     *
     * @param mixed $compareTo
     */
    public function __construct($compareTo)
    {
        $this->compareTo = $compareTo;
    }
    /**
     * {@inheritDoc}
     */
    public function validate($input) : bool
    {
        return $input === $this->compareTo;
    }
}
