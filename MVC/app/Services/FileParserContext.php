<?php

declare (strict_types=1);

namespace App\Services;

class FileParserContext
{
    private FileParserStrategy $strategy;

    public function setStrategy(FileParserStrategy $strategy): void
    {
        $this->strategy = $strategy;
    }

    public function parse(string $filePath): array
    {
        return $this->strategy->parse($filePath);
    }
}
