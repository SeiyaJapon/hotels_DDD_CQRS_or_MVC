<?php

declare (strict_types=1);

namespace App\HotelsContext\Domain\Hotel\Services;

use App\HotelsContext\Domain\Hotel\Hotel;
use App\HotelsContext\Domain\Hotel\HotelRepositoryInterface;

class GetHotelService
{
    private HotelRepositoryInterface $repository;

    public function __construct(HotelRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function get(string $id): ?Hotel
    {
        return $this->repository->findById($id);
    }
}
