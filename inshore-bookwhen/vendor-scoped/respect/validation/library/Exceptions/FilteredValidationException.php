<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */
declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\Respect\Validation\Exceptions;

/**
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
class FilteredValidationException extends ValidationException
{
    public const EXTRA = 'extra';
    /**
     * {@inheritDoc}
     */
    protected function chooseTemplate() : string
    {
        return $this->getParam('additionalChars') ? self::EXTRA : self::STANDARD;
    }
}
