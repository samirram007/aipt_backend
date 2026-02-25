<?php

namespace App\Modules\VoucherParty\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\VoucherParty\Contracts\VoucherPartyServiceInterface;
use App\Modules\VoucherParty\Resources\VoucherPartyResource;
use App\Modules\VoucherParty\Resources\VoucherPartyCollection;
use App\Modules\VoucherParty\Requests\VoucherPartyRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class VoucherPartyController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected VoucherPartyServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new VoucherPartyCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new VoucherPartyResource($data);
    }

    public function store(VoucherPartyRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new VoucherPartyResource($data, $messages='VoucherParty created successfully');
    }

    public function update(VoucherPartyRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new VoucherPartyResource($data, $messages='VoucherParty updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'VoucherParty deleted successfully':'VoucherParty not found',
        ]);
    }
}
