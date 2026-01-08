<?php

namespace App\Modules\PatientTreatment\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\PatientTreatment\Contracts\PatientTreatmentServiceInterface;
use App\Modules\PatientTreatment\Resources\PatientTreatmentResource;
use App\Modules\PatientTreatment\Resources\PatientTreatmentCollection;
use App\Modules\PatientTreatment\Requests\PatientTreatmentRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class PatientTreatmentController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected PatientTreatmentServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new PatientTreatmentCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new PatientTreatmentResource($data);
    }

    public function store(PatientTreatmentRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new PatientTreatmentResource($data, $messages='PatientTreatment created successfully');
    }

    public function update(PatientTreatmentRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new PatientTreatmentResource($data, $messages='PatientTreatment updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'PatientTreatment deleted successfully':'PatientTreatment not found',
        ]);
    }
}
