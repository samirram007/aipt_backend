<?php

namespace App\Modules\AccountingPeriod\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\AccountingPeriod\Contracts\AccountingPeriodServiceInterface;
use App\Modules\AccountingPeriod\Resources\AccountingPeriodResource;
use App\Modules\AccountingPeriod\Resources\AccountingPeriodCollection;
use App\Modules\AccountingPeriod\Requests\AccountingPeriodRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class AccountingPeriodController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected AccountingPeriodServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new AccountingPeriodCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new AccountingPeriodResource($data);
    }

    public function store(AccountingPeriodRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new AccountingPeriodResource($data, $messages='AccountingPeriod created successfully');
    }

    public function update(AccountingPeriodRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new AccountingPeriodResource($data, $messages='AccountingPeriod updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'AccountingPeriod deleted successfully':'AccountingPeriod not found',
        ]);
    }
}
