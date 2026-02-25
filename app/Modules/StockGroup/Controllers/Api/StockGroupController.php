<?php

namespace App\Modules\StockGroup\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\StockGroup\Contracts\StockGroupServiceInterface;
use App\Modules\StockGroup\Resources\StockGroupResource;
use App\Modules\StockGroup\Resources\StockGroupCollection;
use App\Modules\StockGroup\Requests\StockGroupRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class StockGroupController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected StockGroupServiceInterface $service)
    {
    }

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new StockGroupCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return new StockGroupResource($data);
    }

    public function store(StockGroupRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
        return new StockGroupResource($data, $messages = 'StockGroup created successfully');


    }

    public function update(StockGroupRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return new StockGroupResource($data, $messages = 'StockGroup updated successfully');
    }

    public function destroy(int $id): JsonResponse
    {

        $result = $this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result ? 'StockGroup deleted successfully' : 'StockGroup not found',
        ]);
    }
}
