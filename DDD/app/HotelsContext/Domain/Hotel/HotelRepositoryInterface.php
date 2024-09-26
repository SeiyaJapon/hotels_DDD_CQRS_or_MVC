<?php

declare (strict_types=1);

namespace App\HotelsContext\Domain\Hotel;

interface HotelRepositoryInterface
{
    public function findById(string $id): ?Hotel;
    public function findAll(): array;
    public function save(
        string $id,
        string $name,
        ?string $image,
        int $stars,
        string $city,
        ?string $description
    ): Hotel;
    public function update(
        string $id,
        string $name,
        ?string $image,
        int $stars,
        string $city,
        ?string $description
    ): Hotel;
    public function delete(string $id): void;
}
