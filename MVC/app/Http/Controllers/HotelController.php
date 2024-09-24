<?php

namespace App\Http\Controllers;

use App\Repository\HotelRepositoryInterface;
use Illuminate\Http\Request;

class HotelController extends Controller {
    protected $hotelRepository;

    public function __construct(HotelRepositoryInterface $hotelRepository) {
        $this->hotelRepository = $hotelRepository;
    }

    public function index() {
        return $this->hotelRepository->getAll();
    }

    public function show($id) {
        return $this->hotelRepository->getById($id);
    }

    public function store(Request $request) {
        $data = $this->validateArgs($request);

        return $this->hotelRepository->store($data);
    }

    public function update(Request $request, $id) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|string',
            'stars' => 'required|integer|min:1|max:5',
            'city' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        return $this->hotelRepository->update($id, $data);
    }

    public function destroy($id) {
        return $this->hotelRepository->delete($id);
    }

    /**
     * @param Request $request
     * @return array
     */
    private function validateArgs(Request $request): array
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|string',
            'stars' => 'required|integer|min:1|max:5',
            'city' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        return $data;
    }
}