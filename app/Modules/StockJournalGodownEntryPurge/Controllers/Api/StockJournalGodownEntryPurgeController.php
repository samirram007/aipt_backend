<?php

namespace App\Modules\StockJournalGodownEntryPurge\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\StockJournalGodownEntryPurge\Contracts\StockJournalGodownEntryPurgeServiceInterface;
use App\Modules\StockJournalGodownEntryPurge\Resources\StockJournalGodownEntryPurgeResource;
use App\Modules\StockJournalGodownEntryPurge\Resources\StockJournalGodownEntryPurgeCollection;
use App\Modules\StockJournalGodownEntryPurge\Requests\StockJournalGodownEntryPurgeRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class StockJournalGodownEntryPurgeController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected StockJournalGodownEntryPurgeServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new StockJournalGodownEntryPurgeCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new StockJournalGodownEntryPurgeResource($data);
    }

    public function store(StockJournalGodownEntryPurgeRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new StockJournalGodownEntryPurgeResource($data, $messages='StockJournalGodownEntryPurge created successfully');
    }

    public function update(StockJournalGodownEntryPurgeRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new StockJournalGodownEntryPurgeResource($data, $messages='StockJournalGodownEntryPurge updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'StockJournalGodownEntryPurge deleted successfully':'StockJournalGodownEntryPurge not found',
        ]);
    }
}
