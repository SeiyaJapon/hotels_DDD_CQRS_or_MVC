<?php

declare (strict_types=1);

namespace App\HotelsContext\Domain\Common\Services;

use App\HotelsContext\Domain\Common\FileParserStrategyInterface;

class JsonParser implements FileParserStrategyInterface {
    public function parse(string $filePath): array {
        return json_decode(file_get_contents($filePath), true);
    }
}