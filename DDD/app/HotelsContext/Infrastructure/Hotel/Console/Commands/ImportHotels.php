<?php

namespace App\HotelsContext\Infrastructure\Hotel\Console\Commands;

use App\HotelsContext\Domain\Common\Services\CsvParser;
use App\HotelsContext\Domain\Common\Services\FileParserContext;
use App\HotelsContext\Domain\Common\Services\JsonParser;
use Illuminate\Console\Command;
use App\HotelsContext\Application\Hotel\Command\CreateHotelCommand;
use App\ShareContext\Infrastructure\CommandBus\CommandBusInterface;

class ImportHotels extends Command
{
    protected $signature = 'app:import-hotels {file}';
    protected $description = 'Import hotels from a CSV or JSON file';
    private CommandBusInterface $commandBus;

    public function __construct(CommandBusInterface $commandBus)
    {
        parent::__construct();
        $this->commandBus = $commandBus;
    }

    public function handle(): void
    {
        $filePath = $this->argument('file');

        if (!file_exists($filePath)) {
            $this->error("File does not exist.");
            return;
        }

        $fileParser = new FileParserContext();

        if ($this->isCsv($filePath)) {
            $fileParser->setStrategy(new CsvParser());
        } else {
            $fileParser->setStrategy(new JsonParser());
        }

        $data = $fileParser->parse($filePath);
        $mappedCsvData = $this->mapFields($data);

        foreach ($mappedCsvData as $hotelData) {
            $command = new CreateHotelCommand(
                $hotelData['id'],
                $hotelData['name'],
                $hotelData['image'],
                $hotelData['stars'],
                $hotelData['city'],
                $hotelData['description']
            );
            $this->commandBus->handle($command);
        }

        $this->info("Hotels imported successfully!");
    }

    protected function isCsv($filePath): bool
    {
        return pathinfo($filePath, PATHINFO_EXTENSION) === 'csv';
    }

    private function mapFields(array $data): array
    {
        $fieldMapping = [
            'Hotel Name' => 'name',
            'Image' => 'image',
            'City' => 'city',
            'Address' => 'address',
            'Description' => 'description',
            'Stars' => 'stars'
        ];

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