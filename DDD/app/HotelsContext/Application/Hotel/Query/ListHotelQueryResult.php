<?php

declare(strict_types=1);

namespace App\HotelsContext\Application\Hotel\Query;

use App\ShareContext\Application\Query\QueryResultInterface;

class ListHotelQueryResult implements QueryResultInterface
{
    private array $hotels;

    public function __construct(array $hotels)
    {
        $this->hotels = $hotels;
    }

    public function result(): array
    {
        return $this->hotels;
    }
}
