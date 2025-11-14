<?php

namespace App\Modules\Voucher\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Voucher\Contracts\VoucherServiceInterface;
use App\Modules\Voucher\Resources\VoucherResource;
use App\Modules\Voucher\Resources\VoucherCollection;
use App\Modules\Voucher\Requests\VoucherRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class VoucherController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected VoucherServiceInterface $service)
    {
    }

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        // dd($data);
        return new VoucherCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return new VoucherResource($data);
    }

    public function store(VoucherRequest $request): SuccessResource
    {

        $data = $this->service->store($request->validated());
        return new VoucherResource($data, $messages = 'Voucher created successfully');
    }

    public function update(VoucherRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return new VoucherResource($data, $messages = 'Voucher updated successfully');
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
