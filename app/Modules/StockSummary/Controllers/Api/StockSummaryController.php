<?php

namespace App\Modules\StockSummary\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\StockSummary\Contracts\StockSummaryServiceInterface;
use App\Modules\StockSummary\Resources\StockInHandCollection;
use App\Modules\StockSummary\Resources\StockInHandGodownResource;
use App\Modules\StockSummary\Resources\StockInHandItemDetailsResource;
use App\Modules\StockSummary\Resources\StockInHandResource;
use App\Modules\StockSummary\Resources\StockSummaryResource;
use App\Modules\StockSummary\Resources\StockSummaryCollection;
use App\Modules\StockSummary\Requests\StockSummaryRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class StockSummaryController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected StockSummaryServiceInterface $service)
    {
    }

    public function stock_in_hand(): StockInHandCollection
    {
        $data = $this->service->stockInHand();
        // dd($data);
        return new StockInHandCollection($data);
    }
    public function stock_in_hand_item_wise(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection|array
    {
        $data = $this->service->stock_in_hand_item_wise();
        return StockInHandItemDetailsResource::collection($data);
    }
    public function stock_in_hand_godown_wise(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection|array
    {
        $data = $this->service->stock_in_hand_godown_wise();
        // dd($data);
        return StockInHandGodownResource::collection($data);
    }

    public function net_stock(StockSummaryRequest $request): SuccessResource
    {
        $data = $this->service->netStock($request->validated());
        return new StockSummaryResource($data);
    }

    public function purchase_order_outstanding(): SuccessResource
    {
        $data = $this->service->purchaseOrderOutstanding();
        return new StockSummaryResource($data);
    }
    public function saleble_stock(): SuccessResource
    {
        $data = $this->service->salebleStock();
        return new StockSummaryResource($data);
    }
    public function sales_order_outstanding(): SuccessResource
    {
        $data = $this->service->salesOrderOutstanding();
        return new StockSummaryResource($data);
    }


}
