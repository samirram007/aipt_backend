<?php

namespace App\Modules\Agent\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Agent\Contracts\AgentServiceInterface;
use App\Modules\Agent\Resources\AgentResource;
use App\Modules\Agent\Resources\AgentCollection;
use App\Modules\Agent\Requests\AgentRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected AgentServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new AgentCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new AgentResource($data);
    }

    public function store(AgentRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new AgentResource($data, $messages='Agent created successfully');
    }

    public function update(AgentRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new AgentResource($data, $messages='Agent updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'Agent deleted successfully':'Agent not found',
        ]);
    }
}
