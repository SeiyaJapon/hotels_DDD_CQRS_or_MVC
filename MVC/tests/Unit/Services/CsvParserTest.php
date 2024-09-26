<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Services\CsvParser;
use PHPUnit\Framework\TestCase;

class CsvParserTest extends TestCase
{
    public function testParse()
    {
        $parser = new CsvParser();
        $filePath = tempnam(sys_get_temp_dir(), 'testfile') . '.csv';

        $csvContent = <<<CSV
Hotel Name;Image;City;Address;Description;Stars
Hotel Example;image.jpg;Example City;123 Example St;An example hotel;5
CSV;
        file_put_contents($filePath, $csvContent);

        $expectedOutput = [
            [
                'Hotel Name' => 'Hotel Example',
                'Image' => 'image.jpg',
                'City' => 'Example City',
                'Address' => '123 Example St',
                'Description' => 'An example hotel',
                'Stars' => 5
            ]
        ];

        $result = $parser->parse($filePath);

        $this->assertEquals($expectedOutput, $result);

        unlink($filePath);
    }
}