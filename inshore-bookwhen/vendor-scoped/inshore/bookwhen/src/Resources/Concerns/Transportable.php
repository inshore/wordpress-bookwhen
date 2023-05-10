<?php

declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\InShore\Bookwhen\Resources\Concerns;

use _PhpScoper6af4d594edb1\InShore\Bookwhen\Contracts\TransporterContract;
trait Transportable
{
    /**
     * Creates a Client instance with the given API token.
     */
    public function __construct(private readonly TransporterContract $transporter)
    {
        // ..
    }
}
