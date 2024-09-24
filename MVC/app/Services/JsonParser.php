<?php

declare (strict_types=1);

namespace App\Services;

class JsonParser implements FileParserStrategy {
    public function parse(string $filePath): array {
        return json_decode(file_get_contents($filePath), true);
    }
}