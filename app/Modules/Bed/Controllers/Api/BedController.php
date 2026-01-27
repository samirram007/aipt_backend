<?php

namespace App\Modules\Bed\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Bed\Contracts\BedServiceInterface;
use App\Modules\Bed\Resources\BedResource;
use App\Modules\Bed\Resources\BedCollection;
use App\Modules\Bed\Requests\BedRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class BedController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected BedServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new BedCollection($data);
    }

    public function show(string $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new BedResource($data);
    }

    public function store(BedRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
        return  new BedResource($data, $messages = 'Bed created successfully');
    }

    public function update(BedRequest $request, string $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new BedResource($data, $messages = 'Bed updated successfully');
    }

    public function destroy(int $id): JsonResponse
    {

        $result = $this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result ? 'Bed deleted successfully' : 'Bed not found',
        ]);
    }
}
