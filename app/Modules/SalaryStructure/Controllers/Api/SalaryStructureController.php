<?php

namespace App\Modules\SalaryStructure\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\SalaryStructure\Contracts\SalaryStructureServiceInterface;
use App\Modules\SalaryStructure\Resources\SalaryStructureResource;
use App\Modules\SalaryStructure\Resources\SalaryStructureCollection;
use App\Modules\SalaryStructure\Requests\SalaryStructureRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class SalaryStructureController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected SalaryStructureServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new SalaryStructureCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new SalaryStructureResource($data);
    }

    public function store(SalaryStructureRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new SalaryStructureResource($data, $messages='SalaryStructure created successfully');
    }

    public function update(SalaryStructureRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new SalaryStructureResource($data, $messages='SalaryStructure updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'SalaryStructure deleted successfully':'SalaryStructure not found',
        ]);
    }
}
