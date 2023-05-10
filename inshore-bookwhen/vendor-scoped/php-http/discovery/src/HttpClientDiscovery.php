<?php

namespace _PhpScoper6af4d594edb1\Http\Discovery;

use _PhpScoper6af4d594edb1\Http\Client\HttpClient;
use _PhpScoper6af4d594edb1\Http\Discovery\Exception\DiscoveryFailedException;
/**
 * Finds an HTTP Client.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * @deprecated This will be removed in 2.0. Consider using Psr18FactoryDiscovery.
 */
final class HttpClientDiscovery extends ClassDiscovery
{
    /**
     * Finds an HTTP Client.
     *
     * @return HttpClient
     *
     * @throws Exception\NotFoundException
     */
    public static function find()
    {
        try {
            $client = static::findOneByType(HttpClient::class);
        } catch (DiscoveryFailedException $e) {
            throw new NotFoundException('No HTTPlug clients found. Make sure to install a package providing "php-http/client-implementation". Example: "php-http/guzzle6-adapter".', 0, $e);
        }
        return static::instantiateClass($client);
    }
}
