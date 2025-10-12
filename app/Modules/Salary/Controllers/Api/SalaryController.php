<?php

namespace App\Modules\Salary\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Salary\Contracts\SalaryServiceInterface;
use App\Modules\Salary\Resources\SalaryResource;
use App\Modules\Salary\Resources\SalaryCollection;
use App\Modules\Salary\Requests\SalaryRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class SalaryController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected SalaryServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new SalaryCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new SalaryResource($data);
    }

    public function store(SalaryRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new SalaryResource($data, $messages='Salary created successfully');
    }

    public function update(SalaryRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new SalaryResource($data, $messages='Salary updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'Salary deleted successfully':'Salary not found',
        ]);
    }
}
