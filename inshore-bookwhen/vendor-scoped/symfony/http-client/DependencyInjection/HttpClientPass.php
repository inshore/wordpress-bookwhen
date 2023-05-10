<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper6af4d594edb1\Symfony\Component\HttpClient\DependencyInjection;

use _PhpScoper6af4d594edb1\Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use _PhpScoper6af4d594edb1\Symfony\Component\DependencyInjection\ContainerBuilder;
use _PhpScoper6af4d594edb1\Symfony\Component\DependencyInjection\ContainerInterface;
use _PhpScoper6af4d594edb1\Symfony\Component\DependencyInjection\Reference;
use _PhpScoper6af4d594edb1\Symfony\Component\HttpClient\TraceableHttpClient;
final class HttpClientPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container) : void
    {
        if (!$container->hasDefinition('data_collector.http_client')) {
            return;
        }
        foreach ($container->findTaggedServiceIds('http_client.client') as $id => $tags) {
            $container->register('.debug.' . $id, TraceableHttpClient::class)->setArguments([new Reference('.debug.' . $id . '.inner'), new Reference('debug.stopwatch', ContainerInterface::IGNORE_ON_INVALID_REFERENCE)])->addTag('kernel.reset', ['method' => 'reset'])->setDecoratedService($id, null, 5);
            $container->getDefinition('data_collector.http_client')->addMethodCall('registerClient', [$id, new Reference('.debug.' . $id)]);
        }
    }
}
