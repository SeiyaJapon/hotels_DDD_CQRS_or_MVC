<?php

declare (strict_types=1);

namespace App\HotelsContext\Infrastructure\Hotel\Http;

use App\HotelsContext\Domain\Hotel\HotelRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ListHotelsController extends Controller
{
    private HotelRepositoryInterface $hotelRepository;

    public function __construct(HotelRepositoryInterface $hotelRepository)
    {
        $this->hotelRepository = $hotelRepository;
    }

    public function __invoke(): JsonResponse
    {
        $hotels = $this->hotelRepository->findAll();
        return new JsonResponse($hotels, 200);
    }
}