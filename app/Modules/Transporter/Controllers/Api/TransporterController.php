<?php

namespace App\Modules\Transporter\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Transporter\Contracts\TransporterServiceInterface;
use App\Modules\Transporter\Resources\TransporterResource;
use App\Modules\Transporter\Resources\TransporterCollection;
use App\Modules\Transporter\Requests\TransporterRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class TransporterController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected TransporterServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new TransporterCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new TransporterResource($data);
    }

    public function store(TransporterRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new TransporterResource($data, $messages='Transporter created successfully');
    }

    public function update(TransporterRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new TransporterResource($data, $messages='Transporter updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'Transporter deleted successfully':'Transporter not found',
        ]);
    }
}
