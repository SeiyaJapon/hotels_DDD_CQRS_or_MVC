<?php

declare (strict_types=1);

namespace App\HotelsContext\Infrastructure\Hotel\Http;

use App\HotelsContext\Domain\Hotel\HotelRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;

class GetHotelController extends Controller
{
    private HotelRepositoryInterface $hotelRepository;

    public function __construct(HotelRepositoryInterface $hotelRepository)
    {
        $this->hotelRepository = $hotelRepository;
    }

    public function __invoke(Request $request, string $id): JsonResponse
    {
        $hotel = $this->hotelRepository->findById($id);
        if ($hotel === null) {
            return new JsonResponse(['message' => 'Hotel not found'], 404);
        }
        return new JsonResponse($hotel, 200);
    }
}