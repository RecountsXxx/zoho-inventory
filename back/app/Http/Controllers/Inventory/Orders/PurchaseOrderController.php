<?php

namespace App\Http\Controllers\Inventory\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\PurchaseOrderRequest;
use App\Services\Modules\Orders\PurchaseOrderService;


class PurchaseOrderController extends Controller
{
    public function __construct(private PurchaseOrderService $orderService) {}

    public function store(PurchaseOrderRequest $request)
    {
        return $this->orderService->storeOrder($request->validated());
    }
}
