<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */
declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\Respect\Validation\Message;

interface ParameterStringifier
{
    /**
     * @param mixed $value
     */
    public function stringify(string $name, $value) : string;
}
