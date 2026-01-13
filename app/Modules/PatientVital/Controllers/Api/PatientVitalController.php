<?php

namespace App\Modules\PatientVital\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\PatientVital\Contracts\PatientVitalServiceInterface;
use App\Modules\PatientVital\Resources\PatientVitalResource;
use App\Modules\PatientVital\Resources\PatientVitalCollection;
use App\Modules\PatientVital\Requests\PatientVitalRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class PatientVitalController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected PatientVitalServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new PatientVitalCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new PatientVitalResource($data);
    }

    public function store(PatientVitalRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new PatientVitalResource($data, $messages='PatientVital created successfully');
    }

    public function update(PatientVitalRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new PatientVitalResource($data, $messages='PatientVital updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'PatientVital deleted successfully':'PatientVital not found',
        ]);
    }
}
