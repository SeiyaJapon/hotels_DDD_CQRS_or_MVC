<?php

declare (strict_types=1);

namespace App\HotelsContext\Domain\Hotel\Services;

use App\HotelsContext\Domain\Hotel\HotelRepositoryInterface;

class DeleteHotelService
{
    private HotelRepositoryInterface $repository;

    public function __construct(HotelRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function delete(string $id): void
    {
        $this->repository->delete($id);
    }
}
