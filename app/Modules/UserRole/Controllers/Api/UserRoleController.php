<?php

namespace App\Modules\UserRole\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\UserRole\Contracts\UserRoleServiceInterface;
use App\Modules\UserRole\Resources\UserRoleResource;
use App\Modules\UserRole\Resources\UserRoleCollection;
use App\Modules\UserRole\Requests\UserRoleRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class UserRoleController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected UserRoleServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new UserRoleCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new UserRoleResource($data);
    }

    public function store(UserRoleRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new UserRoleResource($data, $messages='UserRole created successfully');
    }

    public function update(UserRoleRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new UserRoleResource($data, $messages='UserRole updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'UserRole deleted successfully':'UserRole not found',
        ]);
    }
}
