<?php

declare (strict_types=1);

namespace App\Repository;

interface HotelRepositoryInterface
{
    public function store(array $data);
    public function getAll();
    public function getById($id);
    public function update($id, array $data);
    public function delete($id);
}
