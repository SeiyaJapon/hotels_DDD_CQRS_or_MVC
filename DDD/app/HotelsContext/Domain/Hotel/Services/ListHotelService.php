<?php

declare (strict_types=1);

namespace App\HotelsContext\Domain\Hotel\Services;

use App\HotelsContext\Domain\Hotel\HotelRepositoryInterface;

class ListHotelService
{
    private HotelRepositoryInterface $repository;

    public function __construct(HotelRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function list(): array
    {
        return $this->repository->findAll();
    }
}
