<?php

declare (strict_types=1);

namespace App\HotelsContext\Infrastructure\Hotel\Http;

use App\HotelsContext\Domain\Hotel\HotelRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class DeleteHotelController extends Controller
{
    private HotelRepositoryInterface $hotelRepository;

    public function __construct(HotelRepositoryInterface $hotelRepository)
    {
        $this->hotelRepository = $hotelRepository;
    }

    public function __invoke(string $id): JsonResponse
    {
        $this->hotelRepository->delete($id);
        return new JsonResponse(['message' => 'Hotel deleted successfully'], 200);
    }
}