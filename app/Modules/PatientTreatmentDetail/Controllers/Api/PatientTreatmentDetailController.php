<?php

namespace App\Modules\PatientTreatmentDetail\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\PatientTreatmentDetail\Contracts\PatientTreatmentDetailServiceInterface;
use App\Modules\PatientTreatmentDetail\Resources\PatientTreatmentDetailResource;
use App\Modules\PatientTreatmentDetail\Resources\PatientTreatmentDetailCollection;
use App\Modules\PatientTreatmentDetail\Requests\PatientTreatmentDetailRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class PatientTreatmentDetailController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected PatientTreatmentDetailServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new PatientTreatmentDetailCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new PatientTreatmentDetailResource($data);
    }

    public function store(PatientTreatmentDetailRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new PatientTreatmentDetailResource($data, $messages='PatientTreatmentDetail created successfully');
    }

    public function update(PatientTreatmentDetailRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new PatientTreatmentDetailResource($data, $messages='PatientTreatmentDetail updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'PatientTreatmentDetail deleted successfully':'PatientTreatmentDetail not found',
        ]);
    }
}
