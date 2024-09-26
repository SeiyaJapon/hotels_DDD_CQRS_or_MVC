<?php

declare (strict_types=1);

namespace App\HotelsContext\Infrastructure\Hotel\Http;

use App\ShareContext\Infrastructure\CommandBus\CommandBusInterface;
use App\HotelsContext\Application\Hotel\Command\UpdateHotelCommand;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateHotelController extends Controller
{
    private CommandBusInterface $commandBus;

    public function __construct(CommandBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(Request $request, string $id): JsonResponse
    {
        $command = new UpdateHotelCommand(
            $id,
            $request->input('name'),
            $request->input('image'),
            $request->input('stars'),
            $request->input('city'),
            $request->input('description')
        );

        $this->commandBus->handle($command);

        return new JsonResponse(['message' => 'Hotel updated successfully'], 200);
    }
}
