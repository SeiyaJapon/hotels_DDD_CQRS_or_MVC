<?php

declare(strict_types=1);

namespace App\HotelsContext\Application\Hotel\Query;

use App\ShareContext\Application\Query\QueryInterface;

class GetHotelQuery implements QueryInterface
{
    public string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }
}
