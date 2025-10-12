<?php

namespace App\Modules\CostCategory\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\CostCategory\Contracts\CostCategoryServiceInterface;
use App\Modules\CostCategory\Resources\CostCategoryResource;
use App\Modules\CostCategory\Resources\CostCategoryCollection;
use App\Modules\CostCategory\Requests\CostCategoryRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class CostCategoryController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected CostCategoryServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new CostCategoryCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new CostCategoryResource($data);
    }

    public function store(CostCategoryRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new CostCategoryResource($data, $messages='CostCategory created successfully');
    }

    public function update(CostCategoryRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new CostCategoryResource($data, $messages='CostCategory updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'CostCategory deleted successfully':'CostCategory not found',
        ]);
    }
}
