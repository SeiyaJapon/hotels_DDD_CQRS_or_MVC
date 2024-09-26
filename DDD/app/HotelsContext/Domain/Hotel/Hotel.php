<?php

declare (strict_types=1);

namespace App\HotelsContext\Domain\Hotel;

class Hotel
{
    private string $id;
    private string $name;
    private ?string $image;
    private int $stars;
    private string $city;
    private ?string $description;

    public function __construct(string $id, string $name, ?string $image, int $stars, string $city, ?string $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->image = $image;
        $this->stars = $stars;
        $this->city = $city;
        $this->description = $description;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function getStars(): int
    {
        return $this->stars;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }
}
