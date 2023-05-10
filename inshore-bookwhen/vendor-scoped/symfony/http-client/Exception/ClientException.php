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

use _PhpScoper6af4d594edb1\Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
/**
 * Represents a 4xx response.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 */
final class ClientException extends \RuntimeException implements ClientExceptionInterface
{
    use HttpExceptionTrait;
}
