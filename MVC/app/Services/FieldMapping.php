<?php

declare (strict_types = 1);

namespace App\Services;

class FieldMapping
{
    public const MAPPING = [
        'Hotel Name' => 'name',
        'Image' => 'image',
        'City' => 'city',
        'Address' => 'address',
        'Description' => 'description',
        'Stars' => 'stars',
    ];

    public static function getMapping(): array
    {
        return self::MAPPING;
    }
}
