<?php

namespace App\Modules\User\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\User\Contracts\UserServiceInterface;
use App\Modules\User\Resources\UserResource;
use App\Modules\User\Resources\UserCollection;
use App\Modules\User\Requests\UserRequest;
use App\Http\Resources\SuccessResource;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected UserServiceInterface $service)
    {
    }

    public function index(): JsonResponse
    {
        $data = $this->service->getAll();
        return (new UserCollection($data))->response();
    }

    public function show(int $id): JsonResponse
    {
        $data = $this->service->getById($id);
        return $this->resourceResponse(
            new UserResource($data),
            'User retrieved successfully'
        );
    }

    public function store(UserRequest $request): JsonResponse
    {
        $data = $this->service->store($request->validated());
        return $this->resourceResponse(
            new UserResource($data),
            'User created successfully',
            201
        );
    }

    public function update(UserRequest $request, int $id): JsonResponse
    {
        $data = $this->service->update($request->validated(), $id);
        return $this->resourceResponse(
            new UserResource($data),
            'User updated successfully'
        );
    }

    public function destroy(int $id): JsonResponse
    {
        $result = $this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result ? 'User deleted successfully' : 'User not found',
        ]);
    }
}
