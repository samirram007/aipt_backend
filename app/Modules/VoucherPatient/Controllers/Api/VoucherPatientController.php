<?php

namespace App\Modules\VoucherPatient\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\VoucherPatient\Contracts\VoucherPatientServiceInterface;
use App\Modules\VoucherPatient\Resources\VoucherPatientResource;
use App\Modules\VoucherPatient\Resources\VoucherPatientCollection;
use App\Modules\VoucherPatient\Requests\VoucherPatientRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class VoucherPatientController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected VoucherPatientServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new VoucherPatientCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new VoucherPatientResource($data);
    }

    public function store(VoucherPatientRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new VoucherPatientResource($data, $messages='VoucherPatient created successfully');
    }

    public function update(VoucherPatientRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new VoucherPatientResource($data, $messages='VoucherPatient updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'VoucherPatient deleted successfully':'VoucherPatient not found',
        ]);
    }
}
