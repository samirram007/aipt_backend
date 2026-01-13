<?php

namespace App\Modules\PatientMedicalHistory\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\PatientMedicalHistory\Contracts\PatientMedicalHistoryServiceInterface;
use App\Modules\PatientMedicalHistory\Resources\PatientMedicalHistoryResource;
use App\Modules\PatientMedicalHistory\Resources\PatientMedicalHistoryCollection;
use App\Modules\PatientMedicalHistory\Requests\PatientMedicalHistoryRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class PatientMedicalHistoryController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected PatientMedicalHistoryServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new PatientMedicalHistoryCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new PatientMedicalHistoryResource($data);
    }

    public function store(PatientMedicalHistoryRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new PatientMedicalHistoryResource($data, $messages='PatientMedicalHistory created successfully');
    }

    public function update(PatientMedicalHistoryRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new PatientMedicalHistoryResource($data, $messages='PatientMedicalHistory updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'PatientMedicalHistory deleted successfully':'PatientMedicalHistory not found',
        ]);
    }
}
