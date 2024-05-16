<?php

namespace App\Services\Modules\Orders;

use App\Services\Helpers\RequestService;

class PurchaseOrderService
{
    public function __construct(private RequestService $requestService){}

    public function storeOrder($data)
    {
        $url = 'https://www.zohoapis.eu/inventory/v1/purchaseorders';

        $response = $this->requestService->makeRequest('post', $url, [
            'vendor_id' => $data['vendor_id'],
            'line_items'=>$data['line_items']
        ]);

        return $response;
    }
}
