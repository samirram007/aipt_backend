<?php

namespace App\Modules\JobOrder\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\JobOrder\Contracts\JobOrderServiceInterface;
use App\Modules\JobOrder\Resources\JobOrderResource;
use App\Modules\JobOrder\Resources\JobOrderCollection;
use App\Modules\JobOrder\Requests\JobOrderRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JobOrderController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected JobOrderServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new JobOrderCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new JobOrderResource($data);
    }

    public function store(JobOrderRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new JobOrderResource($data, $messages='JobOrder created successfully');
    }

    public function update(JobOrderRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new JobOrderResource($data, $messages='JobOrder updated successfully');
    }

    public function uploadReport(Request $request, int $id): ?JsonResponse
    {
        $request->validate([
            'report_file' => ['required', 'file', 'mimes:pdf', 'max:5120'],
        ]);
        return $this->service->upload_report($id);
    }

    public function destroyReport(Request $request, int $id): ?JsonResponse
    {
        return $this->service->destroyReport($id);
    }

    public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'JobOrder deleted successfully':'JobOrder not found',
        ]);
    }
}
