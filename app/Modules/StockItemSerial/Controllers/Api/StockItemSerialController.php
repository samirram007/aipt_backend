<?php

namespace App\Modules\StockItemSerial\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\StockItemSerial\Contracts\StockItemSerialServiceInterface;
use App\Modules\StockItemSerial\Resources\StockItemSerialResource;
use App\Modules\StockItemSerial\Resources\StockItemSerialCollection;
use App\Modules\StockItemSerial\Requests\StockItemSerialRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class StockItemSerialController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected StockItemSerialServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new StockItemSerialCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new StockItemSerialResource($data);
    }

    public function store(StockItemSerialRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new StockItemSerialResource($data, $messages='StockItemSerial created successfully');
    }

    public function update(StockItemSerialRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new StockItemSerialResource($data, $messages='StockItemSerial updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'StockItemSerial deleted successfully':'StockItemSerial not found',
        ]);
    }
}
