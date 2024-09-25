<?php

declare (strict_types=1);

namespace App\HotelsContext\Infrastructure\Hotel\Http;

use App\HotelsContext\Application\Hotel\Query\ListHotelQuery;
use App\HotelsContext\Application\Hotel\Query\ListHotelQueryHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ListHotelsController extends Controller
{
    private ListHotelQueryHandler $queryHandler;

    public function __construct(ListHotelQueryHandler $queryHandler)
    {
        $this->queryHandler = $queryHandler;
    }

    public function __invoke(): JsonResponse
    {
        $result = $this->queryHandler->ask(new ListHotelQuery());

        return new JsonResponse($result->result(), 200);
    }
}
