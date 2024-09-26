<?php

namespace App\Console\Commands;

use App\Repository\FieldMappingServiceInterface;
use App\Repository\HotelRepositoryInterface;
use App\Services\CsvParser;
use App\Services\FileParserContext;
use App\Services\JsonParser;
use Illuminate\Console\Command;

class ImportHotels extends Command {
    protected $signature = 'hotels:import {file}';
    protected $description = 'Import hotels from a CSV or JSON file';

    private HotelRepositoryInterface $repository;
    private FileParserContext $fileParserContext;
    private FieldMappingServiceInterface $fieldMappingService;

    public function __construct(
        HotelRepositoryInterface $repository,
        FileParserContext $fileParserContext,
        FieldMappingServiceInterface $fieldMappingService
    ) {
        parent::__construct();
        $this->repository = $repository;
        $this->fileParserContext = $fileParserContext;
        $this->fieldMappingService = $fieldMappingService;
    }

    public function handle(): void {
        $filePath = $this->argument('file');

        if (!file_exists($filePath)) {
            $this->error("File does not exist.");
            return;
        }

        if ($this->isCsv($filePath)) {
            $this->fileParserContext->setStrategy(new CsvParser());
        } else {
            $this->fileParserContext->setStrategy(new JsonParser());
        }

        $data = $this->fileParserContext->parse($filePath);
        $mappedData = $this->fieldMappingService->mapFields($data);

        foreach ($mappedData as $hotelData) {
            $this->repository->store($hotelData);
        }

        $this->info("Hotels imported successfully!");
    }

    protected function isCsv($filePath): bool {
        return pathinfo($filePath, PATHINFO_EXTENSION) === 'csv';
    }
}