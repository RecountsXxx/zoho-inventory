<?php

namespace App\Services\Modules\Orders;

use App\Services\Helpers\RequestService;

class SalesOrderService
{
    public function __construct(private RequestService $requestService) {}

    public function storeOrder($data)
    {
        $url = 'https://www.zohoapis.eu/inventory/v1/salesorders';

        $response = $this->requestService->makeRequest('post', $url, [
            'customer_id' => $data['customer_id'],
            'line_items'=>$data['line_items'],
            'discount'=>$data['discount'],
            'discount_type'=>"entity_level",
        ]);

        return $response;
    }
}
