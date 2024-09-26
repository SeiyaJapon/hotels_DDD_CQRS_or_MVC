<?php

declare (strict_types=1);

namespace App\Services;

interface FileParserStrategy
{
    public function parse(string $filePath): array;
}
