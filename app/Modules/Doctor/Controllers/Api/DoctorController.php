<?php

namespace App\Modules\Doctor\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Doctor\Contracts\DoctorServiceInterface;
use App\Modules\Doctor\Resources\DoctorResource;
use App\Modules\Doctor\Resources\DoctorCollection;
use App\Modules\Doctor\Requests\DoctorRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class DoctorController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected DoctorServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new DoctorCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new DoctorResource($data);
    }

    public function store(DoctorRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new DoctorResource($data, $messages='Doctor created successfully');
    }

    public function update(DoctorRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new DoctorResource($data, $messages='Doctor updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'Doctor deleted successfully':'Doctor not found',
        ]);
    }
}
