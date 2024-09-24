<?php

declare (strict_types=1);

namespace App\HotelsContext\Domain\Hotel\Services;

use App\HotelsContext\Domain\Hotel\HotelRepositoryInterface;
use Illuminate\Support\Str;

class CreateHotelService
{
    private HotelRepositoryInterface $repository;

    public function __construct(HotelRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(string $name, ?string $image, int $stars, string $city, ?string $description): void
    {
        $this->repository->save(
            (string) Str::uuid(),
            $name,
            $image,
            $stars,
            $city,
            $description
        );
    }
}
