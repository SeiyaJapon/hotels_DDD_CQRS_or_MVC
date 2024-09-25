<?php

declare(strict_types=1);

namespace App\HotelsContext\Application\Hotel\Command;

use App\HotelsContext\Domain\Hotel\Services\DeleteHotelService;

class DeleteHotelCommandHandler
{
    private DeleteHotelService $hotelService;

    public function __construct(DeleteHotelService $hotelService)
    {
        $this->hotelService = $hotelService;
    }

    public function handle(DeleteHotelCommand $command): void
    {
        $this->hotelService->delete($command->id);
    }
}
