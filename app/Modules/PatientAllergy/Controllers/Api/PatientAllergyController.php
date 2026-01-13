<?php

namespace App\Modules\PatientAllergy\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\PatientAllergy\Contracts\PatientAllergyServiceInterface;
use App\Modules\PatientAllergy\Resources\PatientAllergyResource;
use App\Modules\PatientAllergy\Resources\PatientAllergyCollection;
use App\Modules\PatientAllergy\Requests\PatientAllergyRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class PatientAllergyController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected PatientAllergyServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new PatientAllergyCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new PatientAllergyResource($data);
    }

    public function store(PatientAllergyRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new PatientAllergyResource($data, $messages='PatientAllergy created successfully');
    }

    public function update(PatientAllergyRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new PatientAllergyResource($data, $messages='PatientAllergy updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'PatientAllergy deleted successfully':'PatientAllergy not found',
        ]);
    }
}
