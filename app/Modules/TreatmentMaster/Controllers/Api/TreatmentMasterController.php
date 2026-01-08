<?php

namespace App\Modules\TreatmentMaster\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\TreatmentMaster\Contracts\TreatmentMasterServiceInterface;
use App\Modules\TreatmentMaster\Resources\TreatmentMasterResource;
use App\Modules\TreatmentMaster\Resources\TreatmentMasterCollection;
use App\Modules\TreatmentMaster\Requests\TreatmentMasterRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class TreatmentMasterController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected TreatmentMasterServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new TreatmentMasterCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new TreatmentMasterResource($data);
    }

    public function store(TreatmentMasterRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new TreatmentMasterResource($data, $messages='TreatmentMaster created successfully');
    }

    public function update(TreatmentMasterRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new TreatmentMasterResource($data, $messages='TreatmentMaster updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'TreatmentMaster deleted successfully':'TreatmentMaster not found',
        ]);
    }
}
