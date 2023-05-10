<?php

declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\InShore\Bookwhen\Responses\Locations;

use _PhpScoper6af4d594edb1\InShore\Bookwhen\Contracts\ResponseContract;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Responses\Locations\RetrieveResponse;
/**
 * @implements ResponseContract<array{object: string, data: array<int, array{id: string, object: string, created_at: int, bytes: int, filename: string, purpose: string, status: string, status_details: array<array-key, mixed>|string|null}>}>
 */
final class ListResponse implements ResponseContract
{
    /**
     * @param  array<int, RetrieveResponse>  $data
     */
    private function __construct(public readonly array $data)
    {
    }
    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{data: array<int, array{event_id: string, object: string, created_at: int, bytes: int, filename: string, purpose: string, status: string, status_details: array<array-key, mixed>|string|null}>}  $attributes
     */
    public static function from(array $attributes) : self
    {
        $data = \array_map(fn(array $result): RetrieveResponse => RetrieveResponse::from($result), $attributes['data']);
        return new self($data);
    }
}
