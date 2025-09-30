<?php

namespace App\Modules\StockItemPrice\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\StockItemPrice\Contracts\StockItemPriceServiceInterface;
use App\Modules\StockItemPrice\Resources\StockItemPriceResource;
use App\Modules\StockItemPrice\Resources\StockItemPriceCollection;
use App\Modules\StockItemPrice\Requests\StockItemPriceRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class StockItemPriceController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected StockItemPriceServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new StockItemPriceCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new StockItemPriceResource($data);
    }

    public function store(StockItemPriceRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new StockItemPriceResource($data, $messages='StockItemPrice created successfully');
    }

    public function update(StockItemPriceRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new StockItemPriceResource($data, $messages='StockItemPrice updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'StockItemPrice deleted successfully':'StockItemPrice not found',
        ]);
    }
}
