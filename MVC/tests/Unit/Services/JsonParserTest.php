<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Services\JsonParser;
use PHPUnit\Framework\TestCase;

class JsonParserTest extends TestCase
{
    public function testParse()
    {
        $parser = new JsonParser();
        $filePath = tempnam(sys_get_temp_dir(), 'testfile') . '.json';

        $jsonContent = json_encode([
            [
                'Hotel Name' => 'Hotel Example',
                'Image' => 'image.jpg',
                'City' => 'Example City',
                'Address' => '123 Example St',
                'Description' => 'An example hotel',
                'Stars' => 5
            ]
        ]);
        file_put_contents($filePath, $jsonContent);

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
