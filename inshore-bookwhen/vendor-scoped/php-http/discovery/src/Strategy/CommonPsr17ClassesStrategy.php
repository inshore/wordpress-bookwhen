<?php

namespace _PhpScoper6af4d594edb1\Http\Discovery\Strategy;

use _PhpScoper6af4d594edb1\Psr\Http\Message\RequestFactoryInterface;
use _PhpScoper6af4d594edb1\Psr\Http\Message\ResponseFactoryInterface;
use _PhpScoper6af4d594edb1\Psr\Http\Message\ServerRequestFactoryInterface;
use _PhpScoper6af4d594edb1\Psr\Http\Message\StreamFactoryInterface;
use _PhpScoper6af4d594edb1\Psr\Http\Message\UploadedFileFactoryInterface;
use _PhpScoper6af4d594edb1\Psr\Http\Message\UriFactoryInterface;
/**
 * @internal
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 *
 * Don't miss updating src/Composer/Plugin.php when adding a new supported class.
 */
final class CommonPsr17ClassesStrategy implements DiscoveryStrategy
{
    /**
     * @var array
     */
    private static $classes = [RequestFactoryInterface::class => ['_PhpScoper6af4d594edb1\\Phalcon\\Http\\Message\\RequestFactory', '_PhpScoper6af4d594edb1\\Nyholm\\Psr7\\Factory\\Psr17Factory', '_PhpScoper6af4d594edb1\\GuzzleHttp\\Psr7\\HttpFactory', '_PhpScoper6af4d594edb1\\Http\\Factory\\Diactoros\\RequestFactory', '_PhpScoper6af4d594edb1\\Http\\Factory\\Guzzle\\RequestFactory', '_PhpScoper6af4d594edb1\\Http\\Factory\\Slim\\RequestFactory', '_PhpScoper6af4d594edb1\\Laminas\\Diactoros\\RequestFactory', '_PhpScoper6af4d594edb1\\Slim\\Psr7\\Factory\\RequestFactory'], ResponseFactoryInterface::class => ['_PhpScoper6af4d594edb1\\Phalcon\\Http\\Message\\ResponseFactory', '_PhpScoper6af4d594edb1\\Nyholm\\Psr7\\Factory\\Psr17Factory', '_PhpScoper6af4d594edb1\\GuzzleHttp\\Psr7\\HttpFactory', '_PhpScoper6af4d594edb1\\Http\\Factory\\Diactoros\\ResponseFactory', '_PhpScoper6af4d594edb1\\Http\\Factory\\Guzzle\\ResponseFactory', '_PhpScoper6af4d594edb1\\Http\\Factory\\Slim\\ResponseFactory', '_PhpScoper6af4d594edb1\\Laminas\\Diactoros\\ResponseFactory', '_PhpScoper6af4d594edb1\\Slim\\Psr7\\Factory\\ResponseFactory'], ServerRequestFactoryInterface::class => ['_PhpScoper6af4d594edb1\\Phalcon\\Http\\Message\\ServerRequestFactory', '_PhpScoper6af4d594edb1\\Nyholm\\Psr7\\Factory\\Psr17Factory', '_PhpScoper6af4d594edb1\\GuzzleHttp\\Psr7\\HttpFactory', '_PhpScoper6af4d594edb1\\Http\\Factory\\Diactoros\\ServerRequestFactory', '_PhpScoper6af4d594edb1\\Http\\Factory\\Guzzle\\ServerRequestFactory', '_PhpScoper6af4d594edb1\\Http\\Factory\\Slim\\ServerRequestFactory', '_PhpScoper6af4d594edb1\\Laminas\\Diactoros\\ServerRequestFactory', '_PhpScoper6af4d594edb1\\Slim\\Psr7\\Factory\\ServerRequestFactory'], StreamFactoryInterface::class => ['_PhpScoper6af4d594edb1\\Phalcon\\Http\\Message\\StreamFactory', '_PhpScoper6af4d594edb1\\Nyholm\\Psr7\\Factory\\Psr17Factory', '_PhpScoper6af4d594edb1\\GuzzleHttp\\Psr7\\HttpFactory', '_PhpScoper6af4d594edb1\\Http\\Factory\\Diactoros\\StreamFactory', '_PhpScoper6af4d594edb1\\Http\\Factory\\Guzzle\\StreamFactory', '_PhpScoper6af4d594edb1\\Http\\Factory\\Slim\\StreamFactory', '_PhpScoper6af4d594edb1\\Laminas\\Diactoros\\StreamFactory', '_PhpScoper6af4d594edb1\\Slim\\Psr7\\Factory\\StreamFactory'], UploadedFileFactoryInterface::class => ['_PhpScoper6af4d594edb1\\Phalcon\\Http\\Message\\UploadedFileFactory', '_PhpScoper6af4d594edb1\\Nyholm\\Psr7\\Factory\\Psr17Factory', '_PhpScoper6af4d594edb1\\GuzzleHttp\\Psr7\\HttpFactory', '_PhpScoper6af4d594edb1\\Http\\Factory\\Diactoros\\UploadedFileFactory', '_PhpScoper6af4d594edb1\\Http\\Factory\\Guzzle\\UploadedFileFactory', '_PhpScoper6af4d594edb1\\Http\\Factory\\Slim\\UploadedFileFactory', '_PhpScoper6af4d594edb1\\Laminas\\Diactoros\\UploadedFileFactory', '_PhpScoper6af4d594edb1\\Slim\\Psr7\\Factory\\UploadedFileFactory'], UriFactoryInterface::class => ['_PhpScoper6af4d594edb1\\Phalcon\\Http\\Message\\UriFactory', '_PhpScoper6af4d594edb1\\Nyholm\\Psr7\\Factory\\Psr17Factory', '_PhpScoper6af4d594edb1\\GuzzleHttp\\Psr7\\HttpFactory', '_PhpScoper6af4d594edb1\\Http\\Factory\\Diactoros\\UriFactory', '_PhpScoper6af4d594edb1\\Http\\Factory\\Guzzle\\UriFactory', '_PhpScoper6af4d594edb1\\Http\\Factory\\Slim\\UriFactory', '_PhpScoper6af4d594edb1\\Laminas\\Diactoros\\UriFactory', '_PhpScoper6af4d594edb1\\Slim\\Psr7\\Factory\\UriFactory']];
    /**
     * {@inheritdoc}
     */
    public static function getCandidates($type)
    {
        $candidates = [];
        if (isset(self::$classes[$type])) {
            foreach (self::$classes[$type] as $class) {
                $candidates[] = ['class' => $class, 'condition' => [$class]];
            }
        }
        return $candidates;
    }
}
