<?php

declare (strict_types=1);

namespace App\HotelsContext\Infrastructure\Hotel\Http;

use App\HotelsContext\Application\Hotel\Command\DeleteHotelCommand;
use App\ShareContext\Infrastructure\CommandBus\CommandBusInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class DeleteHotelController extends Controller
{
    private CommandBusInterface $commandBus;

    public function __construct(CommandBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(string $id): JsonResponse
    {
        $this->commandBus->handle(
            new DeleteHotelCommand($id)
        );

        return new JsonResponse(['message' => 'Hotel deleted successfully'], 200);
    }
}
