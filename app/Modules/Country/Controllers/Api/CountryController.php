<?php

namespace App\Modules\Country\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Country\Contracts\CountryServiceInterface;
use App\Modules\Country\Resources\CountryResource;
use App\Modules\Country\Resources\CountryCollection;
use App\Modules\Country\Requests\CountryRequest;
use App\Http\Resources\SuccessResource;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class CountryController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected CountryServiceInterface $service) {}

    public function index(): JsonResponse
    {
        $data = $this->service->getAll();
        return (new CountryCollection($data))->response();
    }

    public function show(int $id): JsonResponse
    {
        $data = $this->service->getById($id);
        return $this->resourceResponse(
            new CountryResource($data),
            'Country retrieved successfully'
        );
    }

    public function store(CountryRequest $request): JsonResponse
    {
        $data = $this->service->store($request->validated());
        return $this->resourceResponse(
            new CountryResource($data),
            'Country created successfully',
            201
        );
    }

    public function update(CountryRequest $request, int $id): JsonResponse
    {
        $data = $this->service->update($request->validated(), $id);
        return $this->resourceResponse(
            new CountryResource($data),
            'Country updated successfully'
        );
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);
        return $this->successResponse(
            null,
            'Country deleted successfully'
        );
    }
}
