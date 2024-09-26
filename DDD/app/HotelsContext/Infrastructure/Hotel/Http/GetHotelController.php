<?php

declare (strict_types=1);

namespace App\HotelsContext\Infrastructure\Hotel\Http;

use App\HotelsContext\Application\Hotel\Query\GetHotelQuery;
use App\HotelsContext\Application\Hotel\Query\GetHotelQueryHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetHotelController extends Controller
{
    private GetHotelQueryHandler $queryHandler;

    public function __construct(GetHotelQueryHandler $queryHandler)
    {
        $this->queryHandler = $queryHandler;
    }

    public function __invoke(Request $request, string $id): JsonResponse
    {
        $result = $this->queryHandler->ask(new GetHotelQuery($id));

        if ($result === null) {
            return new JsonResponse(['message' => 'Hotel not found'], 404);
        }

        return new JsonResponse($result->result(), 200);
    }
}
