<?php

namespace App\Modules\Patient\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Patient\Contracts\PatientServiceInterface;
use App\Modules\Patient\Resources\PatientResource;
use App\Modules\Patient\Resources\PatientCollection;
use App\Modules\Patient\Requests\PatientRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class PatientController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected PatientServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new PatientCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new PatientResource($data);
    }

    public function store(PatientRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
        return  new PatientResource($data, $messages='Patient created successfully');
    }

    public function update(PatientRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new PatientResource($data, $messages='Patient updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'Patient deleted successfully':'Patient not found',
        ]);
    }
}
