<?php

namespace App\Modules\TestBooking\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\TestBooking\Contracts\TestBookingServiceInterface;
use App\Modules\TestBooking\Resources\TestBookingResource;
use App\Modules\TestBooking\Resources\TestBookingCollection;
use App\Modules\TestBooking\Requests\TestBookingRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class TestBookingController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected TestBookingServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new TestBookingCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new TestBookingResource($data);
    }

    public function store(TestBookingRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new TestBookingResource($data, $messages='TestBooking created successfully');
    }

    public function update(TestBookingRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new TestBookingResource($data, $messages='TestBooking updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'TestBooking deleted successfully':'TestBooking not found',
        ]);
    }
}
