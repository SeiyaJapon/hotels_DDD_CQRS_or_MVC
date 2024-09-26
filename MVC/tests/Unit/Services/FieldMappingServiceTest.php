<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Services\FieldMappingService;
use PHPUnit\Framework\TestCase;

class FieldMappingServiceTest extends TestCase
{
    public function testMapFields()
    {
        $service = new FieldMappingService();

        $input = [[
            'Hotel Name' => 'Hotel Example',
            'Image' => 'image.jpg',
            'City' => 'Example City',
            'Address' => '123 Example St',
            'Description' => 'An example hotel',
            'Stars' => 5
        ]];
        $expectedOutput = [
            'name' => 'Hotel Example',
            'image' => 'image.jpg',
            'city' => 'Example City',
            'address' => '123 Example St',
            'description' => 'An example hotel',
            'stars' => 5
        ];

        $result = $service->mapFields($input);

        $this->assertEquals($expectedOutput, current($result));
    }
}