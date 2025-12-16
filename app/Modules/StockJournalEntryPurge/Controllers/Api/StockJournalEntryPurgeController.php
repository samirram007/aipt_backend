<?php

namespace App\Modules\StockJournalEntryPurge\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\StockJournalEntryPurge\Contracts\StockJournalEntryPurgeServiceInterface;
use App\Modules\StockJournalEntryPurge\Resources\StockJournalEntryPurgeResource;
use App\Modules\StockJournalEntryPurge\Resources\StockJournalEntryPurgeCollection;
use App\Modules\StockJournalEntryPurge\Requests\StockJournalEntryPurgeRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class StockJournalEntryPurgeController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected StockJournalEntryPurgeServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new StockJournalEntryPurgeCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new StockJournalEntryPurgeResource($data);
    }

    public function store(StockJournalEntryPurgeRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new StockJournalEntryPurgeResource($data, $messages='StockJournalEntryPurge created successfully');
    }

    public function update(StockJournalEntryPurgeRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new StockJournalEntryPurgeResource($data, $messages='StockJournalEntryPurge updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'StockJournalEntryPurge deleted successfully':'StockJournalEntryPurge not found',
        ]);
    }
}
