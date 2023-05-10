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

use _PhpScoper6af4d594edb1\Monolog\Formatter\FormatterInterface;
use _PhpScoper6af4d594edb1\Monolog\Formatter\LineFormatter;
/**
 * Helper trait for implementing FormattableInterface
 *
 * @author Jordi Boggiano <j.boggiano@seld.be>
 */
trait FormattableHandlerTrait
{
    protected FormatterInterface|null $formatter = null;
    /**
     * @inheritDoc
     */
    public function setFormatter(FormatterInterface $formatter) : HandlerInterface
    {
        $this->formatter = $formatter;
        return $this;
    }
    /**
     * @inheritDoc
     */
    public function getFormatter() : FormatterInterface
    {
        if (null === $this->formatter) {
            $this->formatter = $this->getDefaultFormatter();
        }
        return $this->formatter;
    }
    /**
     * Gets the default formatter.
     *
     * Overwrite this if the LineFormatter is not a good default for your handler.
     */
    protected function getDefaultFormatter() : FormatterInterface
    {
        return new LineFormatter();
    }
}
