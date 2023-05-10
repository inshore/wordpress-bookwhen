<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */
declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\Respect\Validation\Exceptions;

/**
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Kleber Hamada Sato <kleberhs007@yahoo.com>
 */
final class VowelException extends FilteredValidationException
{
    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [self::MODE_DEFAULT => [self::STANDARD => '{{name}} must contain only vowels', self::EXTRA => '{{name}} must contain only vowels and {{additionalChars}}'], self::MODE_NEGATIVE => [self::STANDARD => '{{name}} must not contain vowels', self::EXTRA => '{{name}} must not contain vowels or {{additionalChars}}']];
}
