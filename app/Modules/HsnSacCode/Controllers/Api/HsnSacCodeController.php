<?php

namespace App\Modules\HsnSacCode\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\HsnSacCode\Contracts\HsnSacCodeServiceInterface;
use App\Modules\HsnSacCode\Resources\HsnSacCodeResource;
use App\Modules\HsnSacCode\Resources\HsnSacCodeCollection;
use App\Modules\HsnSacCode\Requests\HsnSacCodeRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class HsnSacCodeController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected HsnSacCodeServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new HsnSacCodeCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new HsnSacCodeResource($data);
    }

    public function store(HsnSacCodeRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new HsnSacCodeResource($data, $messages='HsnSacCode created successfully');
    }

    public function update(HsnSacCodeRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new HsnSacCodeResource($data, $messages='HsnSacCode updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'HsnSacCode deleted successfully':'HsnSacCode not found',
        ]);
    }
}
