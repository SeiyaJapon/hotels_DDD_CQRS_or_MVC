<?php

declare(strict_types=1);

namespace App\HotelsContext\Application\Hotel\Command;

use App\HotelsContext\Domain\Hotel\Services\UpdateHotelService;

class UpdateHotelCommandHandler
{
    private UpdateHotelService $hotelService;

    public function __construct(UpdateHotelService $hotelService)
    {
        $this->hotelService = $hotelService;
    }

    public function handle(UpdateHotelCommand $command): void
    {
        $this->hotelService->update(
            $command->id,
            $command->name,
            $command->image,
            $command->stars,
            $command->city,
            $command->description
        );
    }
}
