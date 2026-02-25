<?php

namespace App\Modules\Module\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Module\Contracts\ModuleServiceInterface;
use App\Modules\Module\Resources\ModuleResource;
use App\Modules\Module\Resources\ModuleCollection;
use App\Modules\Module\Requests\ModuleRequest;
use App\Http\Resources\SuccessResource;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class ModuleController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected ModuleServiceInterface $service) {}

    public function index(): JsonResponse
    {
        $data = $this->service->getAll();
        return (new ModuleCollection($data))->response();
    }

    public function show(int $id): JsonResponse
    {
        $data = $this->service->getById($id);
        return $this->resourceResponse(
            new ModuleResource($data),
            'Module retrieved successfully'
        );
    }

    public function store(ModuleRequest $request): JsonResponse
    {
        $data = $this->service->store($request->validated());
        return $this->resourceResponse(
            new ModuleResource($data),
            'Module created successfully',
            201
        );
    }

    public function update(ModuleRequest $request, int $id): JsonResponse
    {
        $data = $this->service->update($request->validated(), $id);
        return $this->resourceResponse(
            new ModuleResource($data),
            'Module updated successfully'
        );
    }

    public function destroy(int $id): JsonResponse
    {
        $result = $this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result ? 'Module deleted successfully' : 'Module not found',
        ]);
    }
}
