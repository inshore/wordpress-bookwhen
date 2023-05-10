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
namespace _PhpScoper6af4d594edb1\Monolog\Handler;

use _PhpScoper6af4d594edb1\Monolog\LogRecord;
/**
 * Base Handler class providing the Handler structure, including processors and formatters
 *
 * Classes extending it should (in most cases) only implement write($record)
 *
 * @author Jordi Boggiano <j.boggiano@seld.be>
 * @author Christophe Coevoet <stof@notk.org>
 */
abstract class AbstractProcessingHandler extends AbstractHandler implements ProcessableHandlerInterface, FormattableHandlerInterface
{
    use ProcessableHandlerTrait;
    use FormattableHandlerTrait;
    /**
     * @inheritDoc
     */
    public function handle(LogRecord $record) : bool
    {
        if (!$this->isHandling($record)) {
            return \false;
        }
        if (\count($this->processors) > 0) {
            $record = $this->processRecord($record);
        }
        $record->formatted = $this->getFormatter()->format($record);
        $this->write($record);
        return \false === $this->bubble;
    }
    /**
     * Writes the (already formatted) record down to the log of the implementing handler
     */
    protected abstract function write(LogRecord $record) : void;
    public function reset() : void
    {
        parent::reset();
        $this->resetProcessors();
    }
}
