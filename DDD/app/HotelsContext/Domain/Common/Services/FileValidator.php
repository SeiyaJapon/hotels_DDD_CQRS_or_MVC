<?php

declare (strict_types=1);

namespace App\HotelsContext\Domain\Common\Services;

class FileValidator
{
    public function validate(string $filePath): bool
    {
        return file_exists($filePath) && is_readable($filePath);
    }
}
