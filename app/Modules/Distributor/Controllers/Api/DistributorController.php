<?php

namespace App\Modules\Distributor\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Distributor\Contracts\DistributorServiceInterface;
use App\Modules\Distributor\Resources\DistributorResource;
use App\Modules\Distributor\Resources\DistributorCollection;
use App\Modules\Distributor\Requests\DistributorRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class DistributorController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected DistributorServiceInterface $service)
    {
    }

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new DistributorCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return new DistributorResource($data);
    }

    public function store(DistributorRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
        return new DistributorResource($data, $messages = 'Distributor created successfully');
    }

    public function update(DistributorRequest $request, int $id): SuccessResource
    {
        // dd($request->validated());
        $data = $this->service->update($request->validated(), $id);
        return new DistributorResource($data, $messages = 'Distributor updated successfully');
    }

    public function destroy(int $id): JsonResponse
    {

        $result = $this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result ? 'Distributor deleted successfully' : 'Distributor not found',
        ]);
    }
}
