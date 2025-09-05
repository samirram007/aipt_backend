<?php

namespace App\Modules\Currency\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Currency\Contracts\CurrencyServiceInterface;
use App\Modules\Currency\Resources\CurrencyResource;
use App\Modules\Currency\Resources\CurrencyCollection;
use App\Modules\Currency\Requests\CurrencyRequest;
use App\Http\Resources\SuccessResource;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class CurrencyController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected CurrencyServiceInterface $service) {}

    public function index(): JsonResponse
    {
        $data = $this->service->getAll();
        return (new CurrencyCollection($data))->response();
    }

    public function show(int $id): JsonResponse
    {
        $data = $this->service->getById($id);
        return $this->resourceResponse(
            new CurrencyResource($data),
            'Currency retrieved successfully'
        );
    }

    public function store(CurrencyRequest $request): JsonResponse
    {
        $data = $this->service->store($request->validated());
        return $this->resourceResponse(
            new CurrencyResource($data),
            'Currency created successfully',
            201
        );
    }

    public function update(CurrencyRequest $request, int $id): JsonResponse
    {
        $data = $this->service->update($request->validated(), $id);
        return $this->resourceResponse(
            new CurrencyResource($data),
            'Currency updated successfully'
        );
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);
        return $this->successResponse(
            null,
            'Currency deleted successfully'
        );
    }
}
