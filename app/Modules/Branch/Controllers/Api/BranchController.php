<?php

namespace App\Modules\Branch\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Branch\Contracts\BranchServiceInterface;
use App\Modules\Branch\Resources\BranchResource;
use App\Modules\Branch\Resources\BranchCollection;
use App\Modules\Branch\Requests\BranchRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class BranchController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected BranchServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new BranchCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new BranchResource($data);
    }

    public function store(BranchRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new BranchResource($data, $messages='Branch created successfully');
    }

    public function update(BranchRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new BranchResource($data, $messages='Branch updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'Branch deleted successfully':'Branch not found',
        ]);
    }
}
