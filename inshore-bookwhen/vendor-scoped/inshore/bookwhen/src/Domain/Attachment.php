<?php

declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\InShore\Bookwhen\Domain;

use _PhpScoper6af4d594edb1\InShore\Bookwhen\Domain\Attachment;
final class Attachment
{
    /**
     *
     *
     */
    public function __construct(public readonly null|string $contentType, public readonly null|string $fileUrl, public readonly null|string $fileSizeBytes, public readonly null|string $fileSizeText, public readonly null|string $fileName, public readonly null|string $fileType, public readonly string $id, public readonly null|string $title)
    {
    }
}
