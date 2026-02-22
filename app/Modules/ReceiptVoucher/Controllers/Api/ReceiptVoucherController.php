<?php

namespace App\Modules\ReceiptVoucher\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\ReceiptVoucher\Contracts\ReceiptVoucherServiceInterface;
use App\Modules\ReceiptVoucher\Requests\FreightReceiptVoucherRequest;
use App\Modules\ReceiptVoucher\Resources\ReceiptVoucherResource;

use App\Modules\ReceiptVoucher\Requests\ReceiptVoucherRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;

use App\Modules\Voucher\Resources\VoucherCollection;
use App\Modules\Voucher\Resources\VoucherResource;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class ReceiptVoucherController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected ReceiptVoucherServiceInterface $service)
    {
    }

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new VoucherCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return new VoucherResource($data);
    }

    public function store(ReceiptVoucherRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
        return new ReceiptVoucherResource($data, $messages = 'ReceiptVoucher created successfully');
    }

    public function update(ReceiptVoucherRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return new ReceiptVoucherResource($data, $messages = 'ReceiptVoucher updated successfully');
    }

    public function destroy(int $id): JsonResponse
    {

        $result = $this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result ? 'ReceiptVoucher deleted successfully' : 'ReceiptVoucher not found',
        ]);
    }
    public function freightReceiptVouchers(int $freight_id): SuccessCollection
    {
        $data = $this->service->getFreightReceiptByFreightId($freight_id);
        //dd($data);
        return new VoucherCollection($data);
    }

    public function storeFreightReceiptVoucher(FreightReceiptVoucherRequest $request): SuccessResource
    {
        // dd($request->validated());
        $data = $this->service->storeFreightReceiptVoucher($request->validated());
        return new VoucherResource($data, $messages = 'Freight ReceiptVoucher created successfully');
    }
}
