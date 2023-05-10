<?php

declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\InShore\Bookwhen\Domain;

final class ClassPass
{
    /**
     *
     */
    public function __construct(public readonly null|string $details, public readonly string $id, public readonly int|null $numberAvailable, public readonly null|string $title, public readonly int|null $usageAllowance, public readonly null|string $usageType, public readonly int|null $useRestrictedForDays)
    {
    }
}
