<?php

declare (strict_types=1);

namespace App\HotelsContext\Domain\Hotel\Services;

use App\HotelsContext\Domain\Hotel\HotelRepositoryInterface;

class CreateHotelService
{
    private HotelRepositoryInterface $repository;

    public function __construct(HotelRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(string $id, string $name, ?string $image, int $stars, string $city, ?string $description): void
    {
        $this->repository->save(
            $id,
            $name,
            $image,
            $stars,
            $city,
            $description
        );
    }
}
