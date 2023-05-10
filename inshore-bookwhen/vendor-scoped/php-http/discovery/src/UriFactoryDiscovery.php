<?php

namespace _PhpScoper6af4d594edb1\Http\Discovery;

use _PhpScoper6af4d594edb1\Http\Discovery\Exception\DiscoveryFailedException;
use _PhpScoper6af4d594edb1\Http\Message\UriFactory;
/**
 * Finds a URI Factory.
 *
 * @author David de Boer <david@ddeboer.nl>
 *
 * @deprecated This will be removed in 2.0. Consider using Psr17FactoryDiscovery.
 */
final class UriFactoryDiscovery extends ClassDiscovery
{
    /**
     * Finds a URI Factory.
     *
     * @return UriFactory
     *
     * @throws Exception\NotFoundException
     */
    public static function find()
    {
        try {
            $uriFactory = static::findOneByType(UriFactory::class);
        } catch (DiscoveryFailedException $e) {
            throw new NotFoundException('No uri factories found. To use Guzzle, Diactoros or Slim Framework factories install php-http/message and the chosen message implementation.', 0, $e);
        }
        return static::instantiateClass($uriFactory);
    }
}
