<?php

namespace App\Modules\Role\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Role\Contracts\RoleServiceInterface;
use App\Modules\Role\Resources\RoleResource;
use App\Modules\Role\Resources\RoleCollection;
use App\Modules\Role\Requests\RoleRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class RoleController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected RoleServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new RoleCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new RoleResource($data);
    }

    public function store(RoleRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new RoleResource($data, $messages='Role created successfully');
    }

    public function update(RoleRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new RoleResource($data, $messages='Role updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'Role deleted successfully':'Role not found',
        ]);
    }
}
