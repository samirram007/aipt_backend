<?php

namespace App\Modules\StorageUnit\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\StorageUnit\Contracts\StorageUnitServiceInterface;
use App\Modules\StorageUnit\Resources\StorageUnitResource;
use App\Modules\StorageUnit\Resources\StorageUnitCollection;
use App\Modules\StorageUnit\Requests\StorageUnitRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class StorageUnitController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected StorageUnitServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new StorageUnitCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new StorageUnitResource($data);
    }

    public function store(StorageUnitRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new StorageUnitResource($data, $messages='StorageUnit created successfully');
    }

    public function update(StorageUnitRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new StorageUnitResource($data, $messages='StorageUnit updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'StorageUnit deleted successfully':'StorageUnit not found',
        ]);
    }
}
