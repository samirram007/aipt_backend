<?php

namespace App\Modules\CompanyType\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\CompanyType\Contracts\CompanyTypeServiceInterface;
use App\Modules\CompanyType\Resources\CompanyTypeResource;
use App\Modules\CompanyType\Resources\CompanyTypeCollection;
use App\Modules\CompanyType\Requests\CompanyTypeRequest;
use App\Http\Resources\SuccessResource;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class CompanyTypeController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected CompanyTypeServiceInterface $service) {}

    public function index(): JsonResponse
    {
        $data = $this->service->getAll();
        return (new CompanyTypeCollection($data))->response();
    }

    public function show(int $id): JsonResponse
    {
        $data = $this->service->getById($id);
        return $this->resourceResponse(
            new CompanyTypeResource($data),
            'CompanyType retrieved successfully'
        );
    }

    public function store(CompanyTypeRequest $request): JsonResponse
    {
        $data = $this->service->store($request->validated());
        return $this->resourceResponse(
            new CompanyTypeResource($data),
            'CompanyType created successfully',
            201
        );
    }

    public function update(CompanyTypeRequest $request, int $id): JsonResponse
    {
        $data = $this->service->update($request->validated(), $id);
        return $this->resourceResponse(
            new CompanyTypeResource($data),
            'CompanyType updated successfully'
        );
    }

    public function destroy(int $id): JsonResponse
    {
         $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'CompanyType deleted successfully':'CompanyType not found',
        ]);

    }
}
