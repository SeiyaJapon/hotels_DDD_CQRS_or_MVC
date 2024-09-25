<?php

declare(strict_types=1);

namespace App\HotelsContext\Application\Hotel\Query;

use App\HotelsContext\Domain\Hotel\Services\ListHotelService;

class ListHotelQueryHandler
{
    private ListHotelService $hotelService;

    public function __construct(ListHotelService $hotelService)
    {
        $this->hotelService = $hotelService;
    }

    public function ask(ListHotelQuery $query): ListHotelQueryResult
    {
        $hotels = $this->hotelService->list();

        $results = array_map(function ($hotel) {
            return [
                'id' => $hotel->getId(),
                'name' => $hotel->getName(),
                'image' => $hotel->getImage(),
                'stars' => $hotel->getStars(),
                'city' => $hotel->getCity()
            ];
        }, $hotels);

        return new ListHotelQueryResult($results);
    }
}
