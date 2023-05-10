<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */
declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\Respect\Validation\Rules;

use _PhpScoper6af4d594edb1\Respect\Validation\Exceptions\NoneOfException;
use function count;
/**
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class NoneOf extends AbstractComposite
{
    /**
     * {@inheritDoc}
     */
    public function assert($input) : void
    {
        $exceptions = $this->getAllThrownExceptions($input);
        $numRules = count($this->getRules());
        $numExceptions = count($exceptions);
        if ($numRules !== $numExceptions) {
            /** @var NoneOfException $noneOfException */
            $noneOfException = $this->reportError($input);
            $noneOfException->addChildren($exceptions);
            throw $noneOfException;
        }
    }
    /**
     * {@inheritDoc}
     */
    public function validate($input) : bool
    {
        foreach ($this->getRules() as $rule) {
            if ($rule->validate($input)) {
                return \false;
            }
        }
        return \true;
    }
}
