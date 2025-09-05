<?php

namespace App\Modules\VoucherCategory\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\VoucherCategory\Contracts\VoucherCategoryServiceInterface;
use App\Modules\VoucherCategory\Resources\VoucherCategoryResource;
use App\Modules\VoucherCategory\Resources\VoucherCategoryCollection;
use App\Modules\VoucherCategory\Requests\VoucherCategoryRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class VoucherCategoryController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected VoucherCategoryServiceInterface $service)
    {
    }

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new VoucherCategoryCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return new VoucherCategoryResource($data);
    }

    public function store(VoucherCategoryRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
        return new VoucherCategoryResource($data, $messages = 'VoucherCategory created successfully');
    }

    public function update(VoucherCategoryRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return new VoucherCategoryResource($data, $messages = 'VoucherCategory updated successfully');
    }

    public function destroy(int $id): JsonResponse
    {

        $result = $this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result ? 'VoucherCategory deleted successfully' : 'VoucherCategory not found',
        ]);
    }
}
