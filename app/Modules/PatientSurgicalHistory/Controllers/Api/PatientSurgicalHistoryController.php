<?php

namespace App\Modules\PatientSurgicalHistory\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\PatientSurgicalHistory\Contracts\PatientSurgicalHistoryServiceInterface;
use App\Modules\PatientSurgicalHistory\Resources\PatientSurgicalHistoryResource;
use App\Modules\PatientSurgicalHistory\Resources\PatientSurgicalHistoryCollection;
use App\Modules\PatientSurgicalHistory\Requests\PatientSurgicalHistoryRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class PatientSurgicalHistoryController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected PatientSurgicalHistoryServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new PatientSurgicalHistoryCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new PatientSurgicalHistoryResource($data);
    }

    public function store(PatientSurgicalHistoryRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new PatientSurgicalHistoryResource($data, $messages='PatientSurgicalHistory created successfully');
    }

    public function update(PatientSurgicalHistoryRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new PatientSurgicalHistoryResource($data, $messages='PatientSurgicalHistory updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'PatientSurgicalHistory deleted successfully':'PatientSurgicalHistory not found',
        ]);
    }
}
