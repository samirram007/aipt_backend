<?php

namespace App\Modules\StockJournalStorageUnitEntryPurge\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\StockJournalStorageUnitEntryPurge\Contracts\StockJournalStorageUnitEntryPurgeServiceInterface;
use App\Modules\StockJournalStorageUnitEntryPurge\Resources\StockJournalStorageUnitEntryPurgeResource;
use App\Modules\StockJournalStorageUnitEntryPurge\Resources\StockJournalStorageUnitEntryPurgeCollection;
use App\Modules\StockJournalStorageUnitEntryPurge\Requests\StockJournalStorageUnitEntryPurgeRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class StockJournalStorageUnitEntryPurgeController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected StockJournalStorageUnitEntryPurgeServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new StockJournalStorageUnitEntryPurgeCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new StockJournalStorageUnitEntryPurgeResource($data);
    }

    public function store(StockJournalStorageUnitEntryPurgeRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new StockJournalStorageUnitEntryPurgeResource($data, $messages='StockJournalStorageUnitEntryPurge created successfully');
    }

    public function update(StockJournalStorageUnitEntryPurgeRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new StockJournalStorageUnitEntryPurgeResource($data, $messages='StockJournalStorageUnitEntryPurge updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'StockJournalStorageUnitEntryPurge deleted successfully':'StockJournalStorageUnitEntryPurge not found',
        ]);
    }
}
