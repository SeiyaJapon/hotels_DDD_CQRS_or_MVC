<?php

declare (strict_types=1);

namespace App\HotelsContext\Infrastructure\Hotel\Http;

use App\AuthContext\Infrastructure\CommandBus\CommandBusInterface;
use App\HotelsContext\Application\Hotel\Command\CreateHotelCommand;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;

class CreateHotelController extends Controller
{
    private CommandBusInterface $commandBus;

    public function __construct(CommandBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $command = new CreateHotelCommand(
            $request->input('id'),
            $request->input('name'),
            $request->input('image'),
            $request->input('stars'),
            $request->input('city'),
            $request->input('description')
        );

        $this->commandBus->handle($command);

        return new JsonResponse(['message' => 'Hotel created successfully'], 201);
    }
}
