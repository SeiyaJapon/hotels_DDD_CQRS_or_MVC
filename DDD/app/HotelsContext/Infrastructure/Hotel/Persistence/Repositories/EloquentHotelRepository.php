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

    public function save(Hotel $hotel): void
    {
        EloquentHotel::create([
            'id' => $hotel->getId(),
            'name' => $hotel->getName(),
            'image' => $hotel->getImage(),
            'stars' => $hotel->getStars(),
            'city' => $hotel->getCity(),
            'description' => $hotel->getDescription(),
        ]);
    }

    public function update(Hotel $hotel): void
    {
        $eloquentHotel = EloquentHotel::find($hotel->getId());
        $eloquentHotel->update([
            'name' => $hotel->getName(),
            'image' => $hotel->getImage(),
            'stars' => $hotel->getStars(),
            'city' => $hotel->getCity(),
            'description' => $hotel->getDescription(),
        ]);
    }

    public function delete(string $id): void
    {
        EloquentHotel::find($id)->delete();
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