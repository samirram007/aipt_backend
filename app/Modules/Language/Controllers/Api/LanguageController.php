<?php

namespace App\Modules\Language\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Language\Contracts\LanguageServiceInterface;
use App\Modules\Language\Resources\LanguageResource;
use App\Modules\Language\Resources\LanguageCollection;
use App\Modules\Language\Requests\LanguageRequest;
use App\Http\Resources\SuccessResource;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class LanguageController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected LanguageServiceInterface $service) {}

    public function index(): JsonResponse
    {
        $data = $this->service->getAll();
        return (new LanguageCollection($data))->response();
    }

    public function show(int $id): JsonResponse
    {
        $data = $this->service->getById($id);
        return $this->resourceResponse(
            new LanguageResource($data),
            'Language retrieved successfully'
        );
    }

    public function store(LanguageRequest $request): JsonResponse
    {
        $data = $this->service->store($request->validated());
        return $this->resourceResponse(
            new LanguageResource($data),
            'Language created successfully',
            201
        );
    }

    public function update(LanguageRequest $request, int $id): JsonResponse
    {
        $data = $this->service->update($request->validated(), $id);
        return $this->resourceResponse(
            new LanguageResource($data),
            'Language updated successfully'
        );
    }

    public function destroy(int $id): JsonResponse
    {
        $result = $this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result ? 'Language deleted successfully' : 'Language not found',
        ]);
    }
}
