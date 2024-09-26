<?php

declare (strict_types=1);

namespace App\HotelsContext\Infrastructure\Hotel\Persistence\Repositories;

use App\HotelsContext\Domain\Hotel\Hotel;
use App\HotelsContext\Domain\Hotel\HotelRepositoryInterface;
use App\Models\Hotel as EloquentHotel;

class EloquentHotelRepository implements HotelRepositoryInterface
{
    public function findById(string $id): ?Hotel
    {
        $hotel = EloquentHotel::find($id);
        return $hotel ? $this->mapToDomain($hotel) : null;
    }

    public function findAll(): array
    {
        return EloquentHotel::all()->map(function ($hotel) {
            return $this->mapToDomain($hotel);
        })->toArray();
    }

    public function save(
        string $id,
        string $name,
        ?string $image,
        int $stars,
        string $city,
        ?string $description
    ): Hotel {
        $eloquentHotel = EloquentHotel::create([
            'id' => $id,
            'name' => $name,
            'image' => $image,
            'stars' => $stars,
            'city' => $city,
            'description' => $description,
        ]);

        return $this->mapToDomain($eloquentHotel);
    }

    public function update(
        string $id,
        string $name,
        ?string $image,
        int $stars,
        string $city,
        ?string $description
    ): Hotel {
        $eloquentHotel = EloquentHotel::find($id);
        $eloquentHotel->update([
            'name' => $name,
            'image' => $image,
            'stars' => $stars,
            'city' => $city,
            'description' => $description,
        ]);

        return $this->mapToDomain($eloquentHotel);
    }

    public function delete(string $id): void
    {
        $hotel = EloquentHotel::find($id);
        $hotel->delete();
    }

    private function mapToDomain(EloquentHotel $hotel): Hotel
    {
        return new Hotel(
            $hotel->id,
            $hotel->name,
            $hotel->image,
            $hotel->stars,
            $hotel->city,
            $hotel->description
        );
    }
}
