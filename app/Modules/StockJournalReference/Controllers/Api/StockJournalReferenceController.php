<?php

namespace App\Modules\StockJournalReference\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\StockJournalReference\Contracts\StockJournalReferenceServiceInterface;
use App\Modules\StockJournalReference\Resources\StockJournalReferenceResource;
use App\Modules\StockJournalReference\Resources\StockJournalReferenceCollection;
use App\Modules\StockJournalReference\Requests\StockJournalReferenceRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class StockJournalReferenceController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected StockJournalReferenceServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new StockJournalReferenceCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new StockJournalReferenceResource($data);
    }

    public function store(StockJournalReferenceRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new StockJournalReferenceResource($data, $messages='StockJournalReference created successfully');
    }

    public function update(StockJournalReferenceRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new StockJournalReferenceResource($data, $messages='StockJournalReference updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'StockJournalReference deleted successfully':'StockJournalReference not found',
        ]);
    }
}
