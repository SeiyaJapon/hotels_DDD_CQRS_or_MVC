<?php

declare(strict_types=1);

namespace App\HotelsContext\Domain\Common\Services;

use App\HotelsContext\Domain\Common\FileParserStrategyInterface;

class JsonParser implements FileParserStrategyInterface
{
    public function parse(string $filePath): array
    {
        $jsonContent = file_get_contents($filePath);
        if ($jsonContent === false) {
            throw new \RuntimeException('Failed to read JSON file.');
        }

        $data = json_decode($jsonContent, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException('Invalid JSON format.');
        }

        return $data;
    }
}
