<?php

namespace App\Modules\FacilityCapitalItem\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\FacilityCapitalItem\Contracts\FacilityCapitalItemServiceInterface;
use App\Modules\FacilityCapitalItem\Resources\FacilityCapitalItemResource;
use App\Modules\FacilityCapitalItem\Resources\FacilityCapitalItemCollection;
use App\Modules\FacilityCapitalItem\Requests\FacilityCapitalItemRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class FacilityCapitalItemController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected FacilityCapitalItemServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new FacilityCapitalItemCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new FacilityCapitalItemResource($data);
    }

    public function store(FacilityCapitalItemRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new FacilityCapitalItemResource($data, $messages='FacilityCapitalItem created successfully');
    }

    public function update(FacilityCapitalItemRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new FacilityCapitalItemResource($data, $messages='FacilityCapitalItem updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'FacilityCapitalItem deleted successfully':'FacilityCapitalItem not found',
        ]);
    }
}
