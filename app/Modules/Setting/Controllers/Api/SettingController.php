<?php

namespace App\Modules\Setting\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Setting\Contracts\SettingServiceInterface;
use App\Modules\Setting\Resources\SettingResource;
use App\Modules\Setting\Resources\SettingCollection;
use App\Modules\Setting\Requests\SettingRequest;
use App\Http\Resources\SuccessResource;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class SettingController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected SettingServiceInterface $service) {}

    public function index(): JsonResponse
    {
        $data = $this->service->getAll();
        return (new SettingCollection($data))->response();
    }

    public function show(int $id): JsonResponse
    {
        $data = $this->service->getById($id);
        return $this->resourceResponse(
            new SettingResource($data),
            'Setting retrieved successfully'
        );
    }

    public function store(SettingRequest $request): JsonResponse
    {
        $data = $this->service->store($request->validated());
        return $this->resourceResponse(
            new SettingResource($data),
            'Setting created successfully',
            201
        );
    }

    public function update(SettingRequest $request, int $id): JsonResponse
    {
        $data = $this->service->update($request->validated(), $id);
        return $this->resourceResponse(
            new SettingResource($data),
            'Setting updated successfully'
        );
    }

    public function destroy(int $id): JsonResponse
    {
       $result = $this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result ? 'Setting deleted successfully' : 'Setting not found',
        ]);
    }
}
