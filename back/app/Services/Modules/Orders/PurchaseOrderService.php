<?php

namespace App\Services\Modules\Orders;

use App\Services\Helpers\RequestService;

class PurchaseOrderService
{
    public function __construct(private RequestService $requestService){}

    public function storeOrder($data)
    {
        $response = $this->requestService->makeRequest('post', '/purchaseorders', [
            'vendor_id' => $data['vendor_id'],
            'line_items'=>$data['line_items']
        ]);

        return $response;
    }
}
