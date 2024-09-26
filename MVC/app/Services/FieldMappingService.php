<?php

declare (strict_types=1);

namespace App\Services;

use App\Repository\FieldMappingServiceInterface;

class FieldMappingService implements FieldMappingServiceInterface
{
    public function mapFields(array $data): array {
        $fieldMapping = FieldMapping::getMapping();

        $mappedData = [];
        foreach ($data as $item) {
            $mappedItem = [];
            foreach ($item as $key => $value) {
                if (isset($fieldMapping[$key])) {
                    $mappedItem[$fieldMapping[$key]] = $value;
                }
            }
            $mappedData[] = $mappedItem;
        }

        return $mappedData;
    }
}