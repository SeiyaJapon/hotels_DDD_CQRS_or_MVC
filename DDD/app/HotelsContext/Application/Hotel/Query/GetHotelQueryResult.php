<?php

declare(strict_types=1);

namespace App\HotelsContext\Application\Hotel\Query;

use App\ShareContext\Application\Query\QueryResultInterface;

class GetHotelQueryResult implements QueryResultInterface
{
    private string $id;
    private string $name;
    private ?string $image;
    private int $stars;
    private string $city;
    private ?string $description;

    public function __construct(
        string $id,
        string $name,
        ?string $image,
        int $stars,
        string $city,
        ?string $description
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->image = $image;
        $this->stars = $stars;
        $this->city = $city;
        $this->description = $description;
    }

    public function result(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image,
            'stars' => $this->stars,
            'city' => $this->city,
            'description' => $this->description
        ];
    }
}
