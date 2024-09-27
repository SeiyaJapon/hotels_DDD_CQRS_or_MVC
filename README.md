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

The project includes a command to import a list of hotels from a CSV or JSON file into a local database. While this project is designed with a small dataset in mind, I am aware that it could be scaled to handle much larger datasets containing thousands of records. Although this project does not implement such a large-scale import, I have a separate repository that demonstrates how to handle large data imports using events and queues. If the approach required such a solution, I have experience implementing it. You can find an example of this implementation here: https://github.com/SeiyaJapon/events-service-ddd-cqrs-events-queues.

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
```
2. Install dependencies:

```bash
composer install
```
3. Run migrations to set up the database:

```bash
php artisan migrate
```
4. Run the import command:

```bash
php artisan app:import-hotels {file}
```
5. Run unit tests:
    
```bash
php artisan test
```

## Conclusion
This project demonstrates two approaches (MVC and DDD) to implementing a hotel management system in Laravel. Both versions include unit tests, follow best practices, and are designed to be easily extensible. For larger-scale imports, check out the linked repository that demonstrates how to handle large datasets efficiently using events and queues.