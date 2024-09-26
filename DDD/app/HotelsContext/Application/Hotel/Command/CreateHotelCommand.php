<?php

declare (strict_types=1);

namespace App\HotelsContext\Application\Hotel\Command;

use App\ShareContext\Application\Command\CommandInterface;

class CreateHotelCommand implements CommandInterface
{
    public string $id;
    public string $name;
    public ?string $image;
    public int $stars;
    public string $city;
    public ?string $description;

    public function __construct(string $id, string $name, ?string $image, int $stars, string $city, ?string $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->image = $image;
        $this->stars = $stars;
        $this->city = $city;
        $this->description = $description;
    }
}
