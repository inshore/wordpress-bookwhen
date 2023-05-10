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

use _PhpScoper6af4d594edb1\Monolog\Level;
use _PhpScoper6af4d594edb1\Monolog\LogRecord;
use _PhpScoper6af4d594edb1\Monolog\Logger;
use _PhpScoper6af4d594edb1\Psr\Log\LogLevel;
/**
 * Error level based activation strategy.
 *
 * @author Johannes M. Schmitt <schmittjoh@gmail.com>
 */
class ErrorLevelActivationStrategy implements ActivationStrategyInterface
{
    private Level $actionLevel;
    /**
     * @param int|string|Level $actionLevel Level or name or value
     *
     * @phpstan-param value-of<Level::VALUES>|value-of<Level::NAMES>|Level|LogLevel::* $actionLevel
     */
    public function __construct(int|string|Level $actionLevel)
    {
        $this->actionLevel = Logger::toMonologLevel($actionLevel);
    }
    public function isHandlerActivated(LogRecord $record) : bool
    {
        return $record->level->value >= $this->actionLevel->value;
    }
}
