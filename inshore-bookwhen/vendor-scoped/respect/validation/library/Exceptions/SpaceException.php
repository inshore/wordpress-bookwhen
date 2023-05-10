<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */
declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\Respect\Validation\Exceptions;

/**
 * @author Andre Ramaciotti <andre@ramaciotti.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class SpaceException extends FilteredValidationException
{
    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [self::MODE_DEFAULT => [self::STANDARD => '{{name}} must contain only space characters', self::EXTRA => '{{name}} must contain only space characters and {{additionalChars}}'], self::MODE_NEGATIVE => [self::STANDARD => '{{name}} must not contain space characters', self::EXTRA => '{{name}} must not contain space characters or {{additionalChars}}']];
}
