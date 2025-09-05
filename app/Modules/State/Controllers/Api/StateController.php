<?php

namespace App\Modules\State\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\State\Contracts\StateServiceInterface;
use App\Modules\State\Resources\StateResource;
use App\Modules\State\Resources\StateCollection;
use App\Modules\State\Requests\StateRequest;
use App\Http\Resources\SuccessResource;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class StateController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected StateServiceInterface $service) {}

    public function index(): JsonResponse
    {
        $data = $this->service->getAll();
        return (new StateCollection($data))->response();
    }

    public function show(int $id): JsonResponse
    {
        $data = $this->service->getById($id);
        return $this->resourceResponse(
            new StateResource($data),
            'State retrieved successfully'
        );
    }

    public function store(StateRequest $request): JsonResponse
    {
        $data = $this->service->store($request->validated());
        return $this->resourceResponse(
            new StateResource($data),
            'State created successfully',
            201
        );
    }

    public function update(StateRequest $request, int $id): JsonResponse
    {
        $data = $this->service->update($request->validated(), $id);
        return $this->resourceResponse(
            new StateResource($data),
            'State updated successfully'
        );
    }

    public function destroy(int $id): JsonResponse
    {
        $result = $this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result ? 'State deleted successfully' : 'State not found',
        ]);
    }
}
