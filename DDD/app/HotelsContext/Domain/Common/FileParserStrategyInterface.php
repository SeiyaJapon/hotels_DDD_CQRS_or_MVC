<?php

declare (strict_types=1);

namespace App\HotelsContext\Domain\Common;

interface FileParserStrategyInterface
{
    public function parse(string $filePath): array;
}
