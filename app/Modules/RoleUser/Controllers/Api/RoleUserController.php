<?php

namespace App\Modules\RoleUser\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\RoleUser\Contracts\RoleUserServiceInterface;
use App\Modules\RoleUser\Resources\RoleUserResource;
use App\Modules\RoleUser\Resources\RoleUserCollection;
use App\Modules\RoleUser\Requests\RoleUserRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class RoleUserController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected RoleUserServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new RoleUserCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new RoleUserResource($data);
    }

    public function store(RoleUserRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new RoleUserResource($data, $messages='RoleUser created successfully');
    }

    public function update(RoleUserRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new RoleUserResource($data, $messages='RoleUser updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'RoleUser deleted successfully':'RoleUser not found',
        ]);
    }
}
