<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper6af4d594edb1\Symfony\Component\HttpClient\Internal;

use _PhpScoper6af4d594edb1\Http\Client\HttpClient;
use _PhpScoper6af4d594edb1\Http\Message\RequestFactory;
use _PhpScoper6af4d594edb1\Http\Message\StreamFactory;
use _PhpScoper6af4d594edb1\Http\Message\UriFactory;
if (\interface_exists(RequestFactory::class)) {
    /**
     * @internal
     *
     * @deprecated since Symfony 6.3
     */
    interface LegacyHttplugInterface extends HttpClient, RequestFactory, StreamFactory, UriFactory
    {
    }
} else {
    /**
     * @internal
     *
     * @deprecated since Symfony 6.3
     */
    interface LegacyHttplugInterface extends HttpClient
    {
    }
}
