<?php

declare (strict_types=1);

namespace App\HotelsContext\Domain\Hotel;

interface HotelRepositoryInterface
{
    public function findById(string $id): ?Hotel;
    public function findAll(): array;
    public function save(Hotel $hotel): void;
    public function update(Hotel $hotel): void;
    public function delete(string $id): void;
}