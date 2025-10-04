<?php

namespace App\Modules\OrderJournal\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\OrderJournal\Contracts\OrderJournalServiceInterface;
use App\Modules\OrderJournal\Resources\OrderJournalResource;
use App\Modules\OrderJournal\Resources\OrderJournalCollection;
use App\Modules\OrderJournal\Requests\OrderJournalRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class OrderJournalController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected OrderJournalServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new OrderJournalCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new OrderJournalResource($data);
    }

    public function store(OrderJournalRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new OrderJournalResource($data, $messages='OrderJournal created successfully');
    }

    public function update(OrderJournalRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new OrderJournalResource($data, $messages='OrderJournal updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'OrderJournal deleted successfully':'OrderJournal not found',
        ]);
    }
}
