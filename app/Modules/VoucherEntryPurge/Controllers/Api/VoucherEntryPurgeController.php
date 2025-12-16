<?php

namespace App\Modules\VoucherEntryPurge\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\VoucherEntryPurge\Contracts\VoucherEntryPurgeServiceInterface;
use App\Modules\VoucherEntryPurge\Resources\VoucherEntryPurgeResource;
use App\Modules\VoucherEntryPurge\Resources\VoucherEntryPurgeCollection;
use App\Modules\VoucherEntryPurge\Requests\VoucherEntryPurgeRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class VoucherEntryPurgeController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected VoucherEntryPurgeServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new VoucherEntryPurgeCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new VoucherEntryPurgeResource($data);
    }

    public function store(VoucherEntryPurgeRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new VoucherEntryPurgeResource($data, $messages='VoucherEntryPurge created successfully');
    }

    public function update(VoucherEntryPurgeRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new VoucherEntryPurgeResource($data, $messages='VoucherEntryPurge updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'VoucherEntryPurge deleted successfully':'VoucherEntryPurge not found',
        ]);
    }
}
