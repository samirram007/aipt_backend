<?php

namespace App\Modules\RolePermission\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\RolePermission\Contracts\RolePermissionServiceInterface;
use App\Modules\RolePermission\Resources\RolePermissionResource;
use App\Modules\RolePermission\Resources\RolePermissionCollection;
use App\Modules\RolePermission\Requests\RolePermissionRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class RolePermissionController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected RolePermissionServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new RolePermissionCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new RolePermissionResource($data);
    }

    public function store(RolePermissionRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new RolePermissionResource($data, $messages='RolePermission created successfully');
    }

    public function update(RolePermissionRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new RolePermissionResource($data, $messages='RolePermission updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'RolePermission deleted successfully':'RolePermission not found',
        ]);
    }
}
