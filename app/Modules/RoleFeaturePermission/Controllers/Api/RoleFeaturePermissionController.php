<?php

namespace App\Modules\RoleFeaturePermission\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\RoleFeaturePermission\Contracts\RoleFeaturePermissionServiceInterface;
use App\Modules\RoleFeaturePermission\Resources\RoleFeaturePermissionResource;
use App\Modules\RoleFeaturePermission\Resources\RoleFeaturePermissionCollection;
use App\Modules\RoleFeaturePermission\Requests\RoleFeaturePermissionRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class RoleFeaturePermissionController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected RoleFeaturePermissionServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new RoleFeaturePermissionCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new RoleFeaturePermissionResource($data);
    }

    public function store(RoleFeaturePermissionRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new RoleFeaturePermissionResource($data, $messages='RoleFeaturePermission created successfully');
    }

    public function update(RoleFeaturePermissionRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new RoleFeaturePermissionResource($data, $messages='RoleFeaturePermission updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'RoleFeaturePermission deleted successfully':'RoleFeaturePermission not found',
        ]);
    }
}
