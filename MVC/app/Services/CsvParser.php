<?php

declare (strict_types=1);

namespace App\Services;

class CsvParser implements FileParserStrategy {
    public function parse($filePath): array {
        $data = [];
        if (($handle = fopen($filePath, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, ';')) !== false) {
                $data[] = [
                    'name' => $row[0],
                    'image' => $row[1],
                    'stars' => $row[2],
                    'city' => $row[3],
                    'description' => $row[4],
                ];
            }
            fclose($handle);
        }
        return $data;
    }
}
