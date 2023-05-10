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
namespace _PhpScoper6af4d594edb1\Monolog\Processor;

use _PhpScoper6af4d594edb1\Monolog\LogRecord;
/**
 * Adds value of getmypid into records
 *
 * @author Andreas Hörnicke
 */
class ProcessIdProcessor implements ProcessorInterface
{
    /**
     * @inheritDoc
     */
    public function __invoke(LogRecord $record) : LogRecord
    {
        $record->extra['process_id'] = \getmypid();
        return $record;
    }
}
