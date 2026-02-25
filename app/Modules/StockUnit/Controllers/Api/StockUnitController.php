<?php

namespace App\Modules\StockUnit\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\StockUnit\Contracts\StockUnitServiceInterface;
use App\Modules\StockUnit\Resources\StockUnitResource;
use App\Modules\StockUnit\Resources\StockUnitCollection;
use App\Modules\StockUnit\Requests\StockUnitRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class StockUnitController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected StockUnitServiceInterface $service)
    {
    }

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();

        return new StockUnitCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return new StockUnitResource($data);
    }

    public function store(StockUnitRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
        return new StockUnitResource($data, $messages = 'StockUnit created successfully');
    }

    public function update(StockUnitRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return new StockUnitResource($data, $messages = 'StockUnit updated successfully');
    }

    public function destroy(int $id): JsonResponse
    {

        $result = $this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result ? 'StockUnit deleted successfully' : 'StockUnit not found',
        ]);
    }
}
