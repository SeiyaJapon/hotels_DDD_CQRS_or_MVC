<?php

declare (strict_types=1);

namespace App\HotelsContext\Domain\Common\Services;

use App\HotelsContext\Domain\Common\FileParserStrategyInterface;

class FileParserContext {
    private FileParserStrategyInterface $strategy;

    public function setStrategy(FileParserStrategyInterface $strategy): void {
        $this->strategy = $strategy;
    }

    public function parse(string $filePath): array {
        return $this->strategy->parse($filePath);
    }
}