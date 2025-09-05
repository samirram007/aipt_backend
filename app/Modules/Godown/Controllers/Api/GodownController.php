<?php

namespace App\Modules\Godown\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Godown\Contracts\GodownServiceInterface;
use App\Modules\Godown\Resources\GodownResource;
use App\Modules\Godown\Resources\GodownCollection;
use App\Modules\Godown\Requests\GodownRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class GodownController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected GodownServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new GodownCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new GodownResource($data);
    }

    public function store(GodownRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new GodownResource($data, $messages='Godown created successfully');
    }

    public function update(GodownRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new GodownResource($data, $messages='Godown updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'Godown deleted successfully':'Godown not found',
        ]);
    }
}
