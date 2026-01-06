<?php

namespace App\Modules\PatientSession\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\PatientSession\Contracts\PatientSessionServiceInterface;
use App\Modules\PatientSession\Resources\PatientSessionResource;
use App\Modules\PatientSession\Resources\PatientSessionCollection;
use App\Modules\PatientSession\Requests\PatientSessionRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class PatientSessionController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected PatientSessionServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new PatientSessionCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new PatientSessionResource($data);
    }

    public function store(PatientSessionRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new PatientSessionResource($data, $messages='PatientSession created successfully');
    }

    public function update(PatientSessionRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new PatientSessionResource($data, $messages='PatientSession updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'PatientSession deleted successfully':'PatientSession not found',
        ]);
    }
}
