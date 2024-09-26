<?php

declare(strict_types=1);

namespace App\HotelsContext\Domain\Common\Services;

use App\HotelsContext\Domain\Common\FileParserStrategyInterface;

class FileParserContext
{
    private FileParserStrategyInterface $strategy;

    public function setStrategy(FileParserStrategyInterface $strategy): void
    {
        $this->strategy = $strategy;
    }

    public function parse(string $filePath): array
    {
        if (!isset($this->strategy)) {
            throw new \RuntimeException('File parser strategy is not set.');
        }

        return $this->strategy->parse($filePath);
    }
}
