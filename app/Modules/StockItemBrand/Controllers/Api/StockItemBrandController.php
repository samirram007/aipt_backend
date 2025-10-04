<?php

namespace App\Modules\StockItemBrand\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\StockItemBrand\Contracts\StockItemBrandServiceInterface;
use App\Modules\StockItemBrand\Resources\StockItemBrandResource;
use App\Modules\StockItemBrand\Resources\StockItemBrandCollection;
use App\Modules\StockItemBrand\Requests\StockItemBrandRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class StockItemBrandController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected StockItemBrandServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new StockItemBrandCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new StockItemBrandResource($data);
    }

    public function store(StockItemBrandRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new StockItemBrandResource($data, $messages='StockItemBrand created successfully');
    }

    public function update(StockItemBrandRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new StockItemBrandResource($data, $messages='StockItemBrand updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'StockItemBrand deleted successfully':'StockItemBrand not found',
        ]);
    }
}
