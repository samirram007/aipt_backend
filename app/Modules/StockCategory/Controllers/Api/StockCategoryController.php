<?php

namespace App\Modules\StockCategory\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\StockCategory\Contracts\StockCategoryServiceInterface;
use App\Modules\StockCategory\Resources\StockCategoryResource;
use App\Modules\StockCategory\Resources\StockCategoryCollection;
use App\Modules\StockCategory\Requests\StockCategoryRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class StockCategoryController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected StockCategoryServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new StockCategoryCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new StockCategoryResource($data);
    }

    public function store(StockCategoryRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new StockCategoryResource($data, $messages='StockCategory created successfully');
    }

    public function update(StockCategoryRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new StockCategoryResource($data, $messages='StockCategory updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'StockCategory deleted successfully':'StockCategory not found',
        ]);
    }
}
