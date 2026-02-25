<?php

namespace App\Modules\EmployeeGroup\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\EmployeeGroup\Contracts\EmployeeGroupServiceInterface;
use App\Modules\EmployeeGroup\Resources\EmployeeGroupResource;
use App\Modules\EmployeeGroup\Resources\EmployeeGroupCollection;
use App\Modules\EmployeeGroup\Requests\EmployeeGroupRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class EmployeeGroupController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected EmployeeGroupServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new EmployeeGroupCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new EmployeeGroupResource($data);
    }

    public function store(EmployeeGroupRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new EmployeeGroupResource($data, $messages='EmployeeGroup created successfully');
    }

    public function update(EmployeeGroupRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new EmployeeGroupResource($data, $messages='EmployeeGroup updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'EmployeeGroup deleted successfully':'EmployeeGroup not found',
        ]);
    }
}
