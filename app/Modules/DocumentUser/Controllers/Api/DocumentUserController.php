<?php

namespace App\Modules\DocumentUser\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\DocumentUser\Contracts\DocumentUserServiceInterface;
use App\Modules\DocumentUser\Resources\DocumentUserResource;
use App\Modules\DocumentUser\Resources\DocumentUserCollection;
use App\Modules\DocumentUser\Requests\DocumentUserRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class DocumentUserController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected DocumentUserServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new DocumentUserCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new DocumentUserResource($data);
    }

    public function store(DocumentUserRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new DocumentUserResource($data, $messages='DocumentUser created successfully');
    }

    public function update(DocumentUserRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new DocumentUserResource($data, $messages='DocumentUser updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'DocumentUser deleted successfully':'DocumentUser not found',
        ]);
    }
}
