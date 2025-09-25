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

    public function __construct(protected CountryServiceInterface $service)
    {
    }

    public function index(): JsonResponse
    {
        $data = $this->service->getAll();
        return (new CountryCollection($data))->response();
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return new CountryResource($data, $messages = 'Country retrieved successfully');


    }

    public function store(CountryRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
        return new CountryResource($data, $messages = 'Country created successfully');

    }

    public function update(CountryRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return new CountryResource($data, $messages = 'Country updated successfully');

    }

    public function destroy(int $id): JsonResponse
    {

        $result = $this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result ? 'Country deleted successfully' : 'Country not found',
        ]);

    }
}
