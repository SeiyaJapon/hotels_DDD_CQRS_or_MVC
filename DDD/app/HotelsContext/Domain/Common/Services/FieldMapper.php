<?php

declare (strict_types=1);

namespace App\HotelsContext\Domain\Common\Services;

use App\HotelsContext\Domain\Common\FieldMapping;

class FieldMapper
{
    public function map(array $data): array
    {
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
