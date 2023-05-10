<?php

declare (strict_types=1);
/*
 * This file is part of the Monolog package.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper6af4d594edb1\Monolog\Handler\FingersCrossed;

use _PhpScoper6af4d594edb1\Monolog\LogRecord;
/**
 * Interface for activation strategies for the FingersCrossedHandler.
 *
 * @author Johannes M. Schmitt <schmittjoh@gmail.com>
 */
interface ActivationStrategyInterface
{
    /**
     * Returns whether the given record activates the handler.
     */
    public function isHandlerActivated(LogRecord $record) : bool;
}
