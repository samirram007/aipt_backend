<?php

namespace App\Modules\StockItemBatch\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\StockItemBatch\Contracts\StockItemBatchServiceInterface;
use App\Modules\StockItemBatch\Resources\StockItemBatchResource;
use App\Modules\StockItemBatch\Resources\StockItemBatchCollection;
use App\Modules\StockItemBatch\Requests\StockItemBatchRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class StockItemBatchController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected StockItemBatchServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new StockItemBatchCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new StockItemBatchResource($data);
    }

    public function store(StockItemBatchRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new StockItemBatchResource($data, $messages='StockItemBatch created successfully');
    }

    public function update(StockItemBatchRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new StockItemBatchResource($data, $messages='StockItemBatch updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'StockItemBatch deleted successfully':'StockItemBatch not found',
        ]);
    }
}
