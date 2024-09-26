<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Services\FieldMapping;
use PHPUnit\Framework\TestCase;

class FieldMappingTest extends TestCase
{
    public function testGetMapping()
    {
        $expectedMapping = [
            'Hotel Name' => 'name',
            'Image' => 'image',
            'City' => 'city',
            'Address' => 'address',
            'Description' => 'description',
            'Stars' => 'stars',
        ];

        $this->assertEquals($expectedMapping, FieldMapping::getMapping());
    }
}