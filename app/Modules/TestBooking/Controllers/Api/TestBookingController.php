<?php

namespace App\Modules\TestBooking\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\TestBooking\Contracts\TestBookingServiceInterface;
use App\Modules\TestBooking\Resources\TestBookingResource;
use App\Modules\TestBooking\Resources\TestBookingCollection;
use App\Modules\TestBooking\Requests\TestBookingRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Modules\TestBooking\Requests\TestCancelRequest;
use App\Modules\TestBooking\Requests\TestConfirmRequest;
use App\Modules\VoucherPatient\Resources\VoucherPatientCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use App\Modules\TestBooking\Requests\TestRefundConfirmRequest;

class TestBookingController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected TestBookingServiceInterface $service) {}

    public function all_bookings(?string $start_date = null, ?string $end_date = null): SuccessCollection
    {
        $data = $this->service->all_bookings($start_date, $end_date);
        return new VoucherPatientCollection($data);
    }

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        // dd($data->toArray());
        return new TestBookingCollection($data, $messages = "Data fectched successfully");
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new TestBookingResource($data);
    }

    public function store(TestBookingRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
        return  new TestBookingResource((object)$data, $messages = 'TestBooking created successfully');
    }

    public function confirm_payment(TestConfirmRequest $request): SuccessResource
    {
        $data = $this->service->confirm_payment($request->validated());
        return new TestBookingResource($data, $messages = "Payment confirmed successfully");
    }

    public function post_payment_test_cancellation(TestBookingRequest $request): SuccessResource
    {
        $data = $this->service->post_payment_test_cancellation($request->validated());
        return new TestBookingResource($data, $messages = "Test Cancellation done successfully");
    }

    public function test_cancellation(TestCancelRequest $request, int $id): JsonResponse
    {
        $data = $this->service->test_cancellation($request->validated(), $id);
        return new JsonResponse([
            'status' => $data,
            'code' => $data ? 204 : 400,
            'message' => $data ? 'Test deleted successfully' : 'Test Entry not found',
        ]);
    }


    public function update(TestBookingRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new TestBookingResource($data, $messages = 'TestBooking updated successfully');
    }


    public function test_refund_request(TestCancelRequest $request, int $id): JsonResponse
    {
        $data = $this->service->test_refund_request($request->validated(), $id);
        return new JsonResponse([
            'status' => $data,
            'code' => $data ? 204 : 400,
            'message' => $data ? 'Test deleted successfully' : 'Test Entry not found',
        ]);
    }

    public function test_refund_confirm(TestRefundConfirmRequest $request): SuccessResource
    {
        $data = $this->service->test_refund_confirm($request->validated());
        return new TestBookingResource($data, $messages = "Payment confirmed successfully");
    }



    public function destroy(int $id): JsonResponse
    {

        $result = $this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result ? 'TestBooking deleted successfully' : 'TestBooking not found',
        ]);
    }
}
