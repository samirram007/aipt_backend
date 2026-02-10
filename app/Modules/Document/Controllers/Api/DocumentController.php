<?php

namespace App\Modules\Document\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Document\Contracts\DocumentServiceInterface;
use App\Modules\Document\Resources\DocumentResource;
use App\Modules\Document\Resources\DocumentCollection;
use App\Modules\Document\Requests\DocumentRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class DocumentController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected DocumentServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new DocumentCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new DocumentResource($data);
    }

    public function store(DocumentRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new DocumentResource($data, $messages='Document created successfully');
    }

    public function update(DocumentRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new DocumentResource($data, $messages='Document updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'Document deleted successfully':'Document not found',
        ]);
    }
}
