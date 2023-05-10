<?php

namespace _PhpScoper6af4d594edb1\Http\Discovery\Strategy;

use _PhpScoper6af4d594edb1\Http\Client\HttpAsyncClient;
use _PhpScoper6af4d594edb1\Http\Client\HttpClient;
use _PhpScoper6af4d594edb1\Http\Mock\Client as Mock;
/**
 * Find the Mock client.
 *
 * @author Sam Rapaport <me@samrapdev.com>
 */
final class MockClientStrategy implements DiscoveryStrategy
{
    /**
     * {@inheritdoc}
     */
    public static function getCandidates($type)
    {
        if (\is_a(HttpClient::class, $type, \true) || \is_a(HttpAsyncClient::class, $type, \true)) {
            return [['class' => Mock::class, 'condition' => Mock::class]];
        }
        return [];
    }
}
