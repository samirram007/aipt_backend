<?php

namespace App\Modules\Freight\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Freight\Contracts\FreightServiceInterface;
use App\Modules\Freight\Resources\FreightResource;
use App\Modules\Freight\Resources\FreightCollection;
use App\Modules\Freight\Requests\FreightRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Modules\Voucher\Resources\VoucherCollection;
use App\Modules\Voucher\Resources\VoucherResource;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class FreightController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected FreightServiceInterface $service)
    {
    }

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new FreightCollection($data);
    }
    public function delivery_note(): SuccessCollection
    {
        $data = $this->service->getDeliveryNote();
        return new VoucherCollection($data);
    }
    public function godown_wise(): SuccessCollection
    {
        $data = $this->service->godownWiseReport();
        return new SuccessCollection($data);
    }
    public function transporter_wise(): SuccessCollection
    {
        $data = $this->service->transporterWiseReport();
        return new SuccessCollection($data);
    }
    public function vehicle_wise(): SuccessCollection
    {
        $data = $this->service->vehicleWiseReport();
        return new SuccessCollection($data);
    }
    public function voucher_wise(): SuccessCollection
    {
        $data = $this->service->voucherWiseReport();
        return new SuccessCollection($data);
    }
    public function billing_preference(): SuccessCollection
    {
        $data = $this->service->billingPreferenceReport();
        return new SuccessCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return new FreightResource($data);
    }

    public function store(FreightRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
        return new VoucherResource($data, $messages = 'Freight created successfully');
    }

    public function update(FreightRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return new FreightResource($data, $messages = 'Freight updated successfully');
    }

    public function destroy(int $id): JsonResponse
    {

        $result = $this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result ? 'Freight deleted successfully' : 'Freight not found',
        ]);
    }
}
