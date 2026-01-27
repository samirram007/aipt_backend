<?php

namespace App\Modules\PhysicalStock\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\PhysicalStock\Contracts\PhysicalStockServiceInterface;
use App\Modules\PhysicalStock\Resources\PhysicalStockResource;
use App\Modules\PhysicalStock\Resources\PhysicalStockCollection;
use App\Modules\PhysicalStock\Requests\PhysicalStockRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class PhysicalStockController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected PhysicalStockServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new PhysicalStockCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new PhysicalStockResource($data);
    }

    public function store(PhysicalStockRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new PhysicalStockResource($data, $messages='PhysicalStock created successfully');
    }

    public function update(PhysicalStockRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new PhysicalStockResource($data, $messages='PhysicalStock updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'PhysicalStock deleted successfully':'PhysicalStock not found',
        ]);
    }
}
