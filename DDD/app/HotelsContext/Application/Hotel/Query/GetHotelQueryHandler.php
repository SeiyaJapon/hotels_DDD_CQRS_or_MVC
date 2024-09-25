<?php

declare(strict_types=1);

namespace App\HotelsContext\Application\Hotel\Query;

use App\HotelsContext\Domain\Hotel\Services\GetHotelService;

class GetHotelQueryHandler
{
    private GetHotelService $hotelService;

    public function __construct(GetHotelService $hotelService)
    {
        $this->hotelService = $hotelService;
    }

    public function ask(GetHotelQuery $query): ?GetHotelQueryResult
    {
        $hotel = $this->hotelService->get($query->id);

        if (!$hotel) {
            return null;
        }

        return new GetHotelQueryResult(
            $hotel->getId(),
            $hotel->getName(),
            $hotel->getImage(),
            $hotel->getStars(),
            $hotel->getCity(),
            $hotel->getDescription()
        );
    }
}
