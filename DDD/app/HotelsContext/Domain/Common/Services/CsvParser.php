<?php

declare(strict_types=1);

namespace App\HotelsContext\Domain\Common\Services;

use App\HotelsContext\Domain\Common\FileParserStrategyInterface;

class CsvParser implements FileParserStrategyInterface
{
    public function parse(string $filePath): array
    {
        $data = [];

        if (($handle = fopen($filePath, 'r')) !== false) {
            $headers = fgetcsv($handle, 0, ';'); // Leer los headers
            if ($headers === false) {
                fclose($handle);
                throw new \RuntimeException('Failed to read headers from CSV file.');
            }

            while (($row = fgetcsv($handle, 0, ';')) !== false) {
                $rowData = [];
                foreach ($headers as $columnIndex => $columnName) {
                    $rowData[$columnName] = $row[$columnIndex] ?? null;
                }
                $data[] = $rowData;
            }
            fclose($handle);
        } else {
            throw new \RuntimeException('Failed to open CSV file.');
        }

        return $data;
    }
}
