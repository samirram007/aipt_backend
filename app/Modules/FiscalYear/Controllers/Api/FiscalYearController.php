<?php

namespace App\Modules\FiscalYear\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\FiscalYear\Contracts\FiscalYearServiceInterface;
use App\Modules\FiscalYear\Resources\FiscalYearResource;
use App\Modules\FiscalYear\Resources\FiscalYearCollection;
use App\Modules\FiscalYear\Requests\FiscalYearRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Http;

class FiscalYearController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected FiscalYearServiceInterface $service)
    {
    }

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new FiscalYearCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return new FiscalYearResource($data);
    }

    public function store(FiscalYearRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
        return new FiscalYearResource($data, $messages = 'FiscalYear created successfully');
    }

    public function update(FiscalYearRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return new FiscalYearResource($data, $messages = 'FiscalYear updated successfully');
    }

    public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'FiscalYear deleted successfully':'FiscalYear not found',
        ]);
    }
}
