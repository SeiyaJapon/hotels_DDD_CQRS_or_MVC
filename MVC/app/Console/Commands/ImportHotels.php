<?php

namespace App\Console\Commands;

use App\Repository\FieldMappingServiceInterface;
use App\Repository\HotelRepositoryInterface;
use App\Services\CsvParser;
use App\Services\FileParserContext;
use App\Services\JsonParser;
use Illuminate\Console\Command;

class ImportHotels extends Command
{
    protected $signature = 'hotels:import {file}';
    protected $description = 'Import hotels from a CSV or JSON file';

    private HotelRepositoryInterface $repository;
    private FileParserContext $fileParserContext;
    private FieldMappingServiceInterface $fieldMappingService;
# Little Emperors Hotel Management

This project was developed in **two versions**, both implementing the same hotel management system but with **different approaches**: one version using **MVC** and another using **DDD (Domain-Driven Design)**.

The **MVC version** was chosen because it's the most common approach to developing a **CRUD in Laravel**, while the **DDD version** was implemented to showcase the benefits of applying a more robust and scalable architecture, especially for complex systems.

## Approaches

### 1. MVC
The **MVC** (Model-View-Controller) approach is the most widely used pattern for developing applications in Laravel. It is **straightforward** and its structure is easy to understand, especially for developers familiar with Laravel. This pattern is typically used for applications where simplicity and rapid development are key priorities.

### 2. DDD (Domain-Driven Design)
The **DDD version** of the project applies **Domain-Driven Design** principles. This approach emphasizes creating a clear separation of concerns by modeling the core business logic and separating it from infrastructure concerns. Some key benefits of DDD include:

- **Better scalability and maintainability**, especially for complex domains.
- **Decoupled architecture**, making it easier to implement changes without affecting other parts of the system.
- **Clear separation of concerns** between the domain logic and infrastructure code.

In addition to DDD, this version also incorporates **CQRS (Command Query Responsibility Segregation)**, where **commands** handle data mutations and **queries** handle data retrieval, allowing for better performance and separation of concerns.

## File Import System

The project includes a command to **import a list of hotels** from a CSV or JSON file into a local database. While this project is designed with a small dataset in mind, it is **scalable** to handle larger datasets. For larger imports involving thousands of records, there is another repository using **events and queues** for efficient batch processing. You can find it here:
[https://github.com/SeiyaJapon/events-service-ddd-cqrs-events-queues](https://github.com/SeiyaJapon/events-service-ddd-cqrs-events-queues)

## Patterns Used

Both the **Repository** and **Strategy** patterns have been applied in this project. These patterns were chosen for their flexibility and reusability. In particular:

- **Repository Pattern**: Abstracts the data layer, allowing the business logic to remain agnostic of how data is fetched or persisted.
- **Strategy Pattern**: Used to switch between different parsing strategies for CSV and JSON file formats in the import command.

In the **DDD** version, we also use **CQRS** to further separate the responsibilities of commands (for mutations) and queries (for read operations).

## Tools and Libraries

In both versions of the project (MVC and DDD), we have used the following tools to maintain high code quality and standards:

- **php-cs-fixer**: Automatically formats code according to predefined coding standards.
- **phpstan**: A static analysis tool that helps detect potential bugs and improve code quality.

## Unit Tests

Both the **MVC** and **DDD** versions come with **complete unit tests** to ensure that all functionality is working as expected. The tests include:

- **Happy path tests** for all features (importing, CRUD operations).
- **Edge case tests** to handle invalid data, missing fields, etc.
- **Tests for both file formats** (CSV and JSON) to ensure the import command works regardless of the format.

Unit tests were designed to cover the entire functionality of the project, including both **CRUD operations** and **the import command**.

## How to Run the Project

1. Clone the repository:

```bash
git clone https://github.com/SeiyaJapon/littleEmperors
cd littleEmperors

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

    public function handle(): void
    {
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

    protected function isCsv($filePath): bool
    {
        return pathinfo($filePath, PATHINFO_EXTENSION) === 'csv';
    }
}
