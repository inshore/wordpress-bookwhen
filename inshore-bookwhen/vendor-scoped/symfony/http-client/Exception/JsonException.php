<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper6af4d594edb1\Symfony\Component\HttpClient\Exception;

use _PhpScoper6af4d594edb1\Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
/**
 * Thrown by responses' toArray() method when their content cannot be JSON-decoded.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 */
final class JsonException extends \JsonException implements DecodingExceptionInterface
{
}
