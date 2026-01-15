<?php

namespace App\Modules\AmenityCategory\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\AmenityCategory\Contracts\AmenityCategoryServiceInterface;
use App\Modules\AmenityCategory\Resources\AmenityCategoryResource;
use App\Modules\AmenityCategory\Resources\AmenityCategoryCollection;
use App\Modules\AmenityCategory\Requests\AmenityCategoryRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class AmenityCategoryController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected AmenityCategoryServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new AmenityCategoryCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new AmenityCategoryResource($data);
    }

    public function store(AmenityCategoryRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new AmenityCategoryResource($data, $messages='AmenityCategory created successfully');
    }

    public function update(AmenityCategoryRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new AmenityCategoryResource($data, $messages='AmenityCategory updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'AmenityCategory deleted successfully':'AmenityCategory not found',
        ]);
    }
}
