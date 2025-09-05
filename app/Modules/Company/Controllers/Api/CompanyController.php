<?php

namespace App\Modules\Company\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Company\Contracts\CompanyServiceInterface;
use App\Modules\Company\Resources\CompanyResource;
use App\Modules\Company\Resources\CompanyCollection;
use App\Modules\Company\Requests\CompanyRequest;
use App\Http\Resources\SuccessResource;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class CompanyController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected CompanyServiceInterface $service) {}

    public function index(): JsonResponse
    {
        $data = $this->service->getAll();
        return (new CompanyCollection($data))->response();
    }

    public function show(int $id): JsonResponse
    {
        $data = $this->service->getById($id);
        return $this->resourceResponse(
            new CompanyResource($data),
            'Company retrieved successfully'
        );
    }

    public function store(CompanyRequest $request): JsonResponse
    {
        $data = $this->service->store($request->validated());
        return $this->resourceResponse(
            new CompanyResource($data),
            'Company created successfully',
            201
        );
    }

    public function update(CompanyRequest $request, int $id): JsonResponse
    {
        $data = $this->service->update($request->validated(), $id);
        return $this->resourceResponse(
            new CompanyResource($data),
            'Company updated successfully'
        );
    }

    public function destroy(int $id): JsonResponse
    {

          $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'Company deleted successfully':'Company not found',
        ]);

    }
}
