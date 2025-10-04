<?php

namespace App\Modules\VoucherReference\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\VoucherReference\Contracts\VoucherReferenceServiceInterface;
use App\Modules\VoucherReference\Resources\VoucherReferenceResource;
use App\Modules\VoucherReference\Resources\VoucherReferenceCollection;
use App\Modules\VoucherReference\Requests\VoucherReferenceRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class VoucherReferenceController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected VoucherReferenceServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new VoucherReferenceCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new VoucherReferenceResource($data);
    }

    public function store(VoucherReferenceRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new VoucherReferenceResource($data, $messages='VoucherReference created successfully');
    }

    public function update(VoucherReferenceRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new VoucherReferenceResource($data, $messages='VoucherReference updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'VoucherReference deleted successfully':'VoucherReference not found',
        ]);
    }
}
