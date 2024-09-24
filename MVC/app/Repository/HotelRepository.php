<?php

declare (strict_types=1);

namespace App\Repository;

use App\Models\Hotel;

class HotelRepository implements HotelRepositoryInterface {
    public function store(array $data) {
        return Hotel::create($data);
    }

    public function getAll() {
        return Hotel::select('id', 'name', 'image', 'stars', 'city')->get();
    }

    public function getById($id) {
        return Hotel::findOrFail($id);
    }

    public function update($id, array $data) {
        $hotel = Hotel::findOrFail($id);
        $hotel->update($data);
        return $hotel;
    }

    public function delete($id) {
        $hotel = Hotel::findOrFail($id);
        $hotel->delete();
    }
}