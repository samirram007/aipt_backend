<?php

namespace App\Modules\SalaryComponent\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\SalaryComponent\Contracts\SalaryComponentServiceInterface;
use App\Modules\SalaryComponent\Resources\SalaryComponentResource;
use App\Modules\SalaryComponent\Resources\SalaryComponentCollection;
use App\Modules\SalaryComponent\Requests\SalaryComponentRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class SalaryComponentController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected SalaryComponentServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new SalaryComponentCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new SalaryComponentResource($data);
    }

    public function store(SalaryComponentRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new SalaryComponentResource($data, $messages='SalaryComponent created successfully');
    }

    public function update(SalaryComponentRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new SalaryComponentResource($data, $messages='SalaryComponent updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'SalaryComponent deleted successfully':'SalaryComponent not found',
        ]);
    }
}
