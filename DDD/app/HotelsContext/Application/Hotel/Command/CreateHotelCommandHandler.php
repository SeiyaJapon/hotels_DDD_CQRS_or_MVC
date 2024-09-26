<?php

declare (strict_types=1);

namespace App\HotelsContext\Application\Hotel\Command;

use App\HotelsContext\Domain\Hotel\Services\CreateHotelService;

class CreateHotelCommandHandler
{
    private CreateHotelService $hotelService;

    public function __construct(CreateHotelService $hotelService)
    {
        $this->hotelService = $hotelService;
    }

    public function handle(CreateHotelCommand $command): void
    {
        $this->hotelService->create(
            $command->id,
            $command->name,
            $command->image,
            $command->stars,
            $command->city,
            $command->description
        );
    }
}
