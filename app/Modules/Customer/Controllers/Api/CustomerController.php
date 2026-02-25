<?php

namespace App\Modules\Customer\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Customer\Contracts\CustomerServiceInterface;
use App\Modules\Customer\Resources\CustomerResource;
use App\Modules\Customer\Resources\CustomerCollection;
use App\Modules\Customer\Requests\CustomerRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected CustomerServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new CustomerCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new CustomerResource($data);
    }

    public function store(CustomerRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new CustomerResource($data, $messages='Customer created successfully');
    }

    public function update(CustomerRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new CustomerResource($data, $messages='Customer updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'Customer deleted successfully':'Customer not found',
        ]);
    }
}
