<?php

declare (strict_types = 1);

namespace App\Services;

class CsvParser implements FileParserStrategy {
	// public function parse($filePath): array {
	//     $data = [];
	//     if (($handle = fopen($filePath, 'r')) !== false) {
	//         while (($row = fgetcsv($handle, 1000, ';')) !== false) {
	//             $data[] = [
	//                 'name' => $row[0],
	//                 'image' => $row[1],
	//                 'stars' => $row[2],
	//                 'city' => $row[3],
	//                 'description' => $row[4],
	//             ];
	//         }
	//         fclose($handle);
	//     }
	//     return $data;
	// }
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
