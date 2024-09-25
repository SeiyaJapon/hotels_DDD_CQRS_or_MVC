<?php

declare (strict_types=1);

namespace App\HotelsContext\Infrastructure\Hotel\Http;

use App\ShareContext\Infrastructure\CommandBus\CommandBusInterface;
use App\HotelsContext\Application\Hotel\Command\CreateHotelCommand;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CreateHotelController extends Controller
{
    private CommandBusInterface $commandBus;

    public function __construct(CommandBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $hotelId = Str::uuid()->toString();

        $command = new CreateHotelCommand(
            $hotelId,
            $request->input('name'),
            $request->input('image'),
            $request->input('stars'),
            $request->input('city'),
            $request->input('description')
        );

        $this->commandBus->handle($command);

        return new JsonResponse(['message' => 'Hotel created successfully. Id: ' . $hotelId], 201);
    }
}
