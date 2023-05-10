<?php

/*
 * This file is part of Respect/Stringifier.
 *
 * (c) Henrique Moody <henriquemoody@gmail.com>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */
declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\Respect\Stringifier\Stringifiers;

use function get_class;
use function iterator_to_array;
use _PhpScoper6af4d594edb1\Respect\Stringifier\Quoter;
use _PhpScoper6af4d594edb1\Respect\Stringifier\Stringifier;
use Traversable;
/**
 * Converts an instance of Traversable into a string.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class TraversableStringifier implements Stringifier
{
    /**
     * @var Stringifier
     */
    private $stringifier;
    /**
     * @var Quoter
     */
    private $quoter;
    /**
     * Initializes the stringifier.
     *
     * @param Stringifier $stringifier
     * @param Quoter $quoter
     */
    public function __construct(Stringifier $stringifier, Quoter $quoter)
    {
        $this->stringifier = $stringifier;
        $this->quoter = $quoter;
    }
    /**
     * {@inheritdoc}
     */
    public function stringify($raw, int $depth) : ?string
    {
        if (!$raw instanceof Traversable) {
            return null;
        }
        return $this->quoter->quote(\sprintf('[traversable] (%s: %s)', get_class($raw), $this->stringifier->stringify(iterator_to_array($raw), $depth + 1)), $depth);
    }
}
