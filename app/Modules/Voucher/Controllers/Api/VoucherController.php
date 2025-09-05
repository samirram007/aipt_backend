<?php

namespace App\Modules\Voucher\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Voucher\Contracts\VoucherServiceInterface;
use App\Modules\Voucher\Resources\VoucherResource;
use App\Modules\Voucher\Resources\VoucherCollection;
use App\Modules\Voucher\Requests\VoucherRequest;
use App\Http\Resources\SuccessResource;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class VoucherController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected VoucherServiceInterface $service) {}

    public function index(): JsonResponse
    {
        $data = $this->service->getAll();
        return (new VoucherCollection($data))->response();
    }

    public function show(int $id): JsonResponse
    {
        $data = $this->service->getById($id);
        return $this->resourceResponse(
            new VoucherResource($data),
            'Voucher retrieved successfully'
        );
    }

    public function store(VoucherRequest $request): JsonResponse
    {
        $data = $this->service->store($request->validated());
        return $this->resourceResponse(
            new VoucherResource($data),
            'Voucher created successfully',
            201
        );
    }

    public function update(VoucherRequest $request, int $id): JsonResponse
    {
        $data = $this->service->update($request->validated(), $id);
        return $this->resourceResponse(
            new VoucherResource($data),
            'Voucher updated successfully'
        );
    }

    public function destroy(int $id): JsonResponse
    {
        $result = $this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result ? 'Voucher deleted successfully' : 'Voucher not found',
        ]);
    }
}
