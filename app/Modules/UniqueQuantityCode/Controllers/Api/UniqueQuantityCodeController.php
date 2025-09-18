<?php

namespace App\Modules\UniqueQuantityCode\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\UniqueQuantityCode\Contracts\UniqueQuantityCodeServiceInterface;
use App\Modules\UniqueQuantityCode\Resources\UniqueQuantityCodeResource;
use App\Modules\UniqueQuantityCode\Resources\UniqueQuantityCodeCollection;
use App\Modules\UniqueQuantityCode\Requests\UniqueQuantityCodeRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class UniqueQuantityCodeController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected UniqueQuantityCodeServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new UniqueQuantityCodeCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new UniqueQuantityCodeResource($data);
    }

    public function store(UniqueQuantityCodeRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new UniqueQuantityCodeResource($data, $messages='UniqueQuantityCode created successfully');
    }

    public function update(UniqueQuantityCodeRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new UniqueQuantityCodeResource($data, $messages='UniqueQuantityCode updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'UniqueQuantityCode deleted successfully':'UniqueQuantityCode not found',
        ]);
    }
}
