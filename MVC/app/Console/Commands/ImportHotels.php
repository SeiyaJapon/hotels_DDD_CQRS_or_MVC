<?php

namespace App\Console\Commands;

use App\Repository\HotelRepository;
use App\Services\CsvParser;
use App\Services\FileParserContext;
use App\Services\JsonParser;
use Illuminate\Console\Command;

class ImportHotels extends Command
{
    protected $signature = 'hotels:import {file}';
    protected $description = 'Import hotels from a CSV or JSON file';
    private HotelRepository $repository;

    public function __construct()
    {
        parent::__construct();

        $this->repository = new HotelRepository();
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
            $this->repository->store($hotelData);
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
