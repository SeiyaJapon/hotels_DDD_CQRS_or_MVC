<?php

declare(strict_types=1);

namespace App\HotelsContext\Application\Hotel\Command;

use App\ShareContext\Application\Command\CommandInterface;

class DeleteHotelCommand implements CommandInterface
{
    public string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }
}
