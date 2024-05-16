<?php

namespace App\Http\Controllers\Inventory\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\SalesOrderRequest;
use App\Services\Modules\Orders\SalesOrderService;


class SalesOrderController extends Controller
{

    public function __construct(private SalesOrderService $orderService) {}

    public function store(SalesOrderRequest $request)
    {
        return $this->orderService->storeOrder($request->validated());
    }
}
