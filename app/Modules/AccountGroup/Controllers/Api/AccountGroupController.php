<?php

namespace App\Modules\AccountGroup\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuccessCollection;
use App\Modules\AccountGroup\Contracts\AccountGroupServiceInterface;
use App\Modules\AccountGroup\Resources\AccountGroupCollection;
use App\Modules\AccountGroup\Resources\AccountGroupResource;

use App\Modules\AccountGroup\Requests\AccountGroupRequest;
use App\Http\Resources\SuccessResource;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class AccountGroupController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected AccountGroupServiceInterface $service)
    {
    }
    /**
     * @OA\Get(
     *     path="/api/account_groups",
     *     summary="Get a list of account groups",
     *     tags={"Account Group"},
     *
     *      security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/AccountGroupResource")
     *             )
     *         )
     *     )
     * )
     */


    public function index(): SuccessCollection
    {

        $data = $this->service->getAll();

        return new AccountGroupCollection($data);
    }

    /**
     * @OA\Get(
     *     path="/api/account_groups/{id}",
     *     summary="Get a specific account group",
     *     tags={"Account Group"},
     *
     * security={{"bearerAuth": {}}},
     * @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the account group",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 ref="#/components/schemas/AccountGroupResource"
     *             )
     *         )
     *     )
     * )
     */
    public function show(int $id): ?SuccessResource
    {
        $data = $this->service->getById($id);
        // dd($data);
        return new AccountGroupResource($data, $message = 'AccountGroup retrieved successfully');
    }

    /**
     * @OA\Post(
     *     path="/api/account_groups",
     *     summary="Create a new account group",
     *     tags={"Account Group"},
     *
     * security={{"bearerAuth": {}}},
     * @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/AccountGroupRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 ref="#/components/schemas/AccountGroupResource"
     *             )
     *         )
     *     )
     * )
     */
    public function store(AccountGroupRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
        return
            new AccountGroupResource(
                $data,
                $message = 'AccountGroup created successfully',
            );
    }

    public function update(AccountGroupRequest $request, int $id): SuccessResource
    {

        $data = $this->service->update($request->validated(), $id);
        return new AccountGroupResource($data, $message = 'AccountGroup updated successfully');
    }

    public function destroy(int $id): JsonResponse
    {

        $result = $this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result ? 'AccountGroup deleted successfully' : 'AccountGroup not found',
        ]);
    }






    public function current_liability_groups(): SuccessCollection
    {

        $data = $this->service->getCurrentLiabilityGroups();

        return new AccountGroupCollection($data);
    }
}
