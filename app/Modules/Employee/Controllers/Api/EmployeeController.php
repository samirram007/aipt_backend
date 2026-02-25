<?php

namespace App\Modules\Employee\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Employee\Contracts\EmployeeServiceInterface;
use App\Modules\Employee\Resources\EmployeeResource;
use App\Modules\Employee\Resources\EmployeeCollection;
use App\Modules\Employee\Requests\EmployeeRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class EmployeeController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected EmployeeServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new EmployeeCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new EmployeeResource($data);
    }

    public function store(EmployeeRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new EmployeeResource($data, $messages='Employee created successfully');
    }

    public function update(EmployeeRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new EmployeeResource($data, $messages='Employee updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'Employee deleted successfully':'Employee not found',
        ]);
    }
}
