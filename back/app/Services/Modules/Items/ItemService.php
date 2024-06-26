<?php

namespace App\Services\Modules\Items;

use App\Services\Helpers\RequestService;

class ItemService
{
    public function __construct(private RequestService $requestService) {}

    public function getItems()
    {
        $response = $this->requestService->makeRequest('get','/items');

        return $response['items'];
    }

    public function getItem(string $id)
    {
        $response = $this->requestService->makeRequest('get',"/items/${id}");

        return $response['item'];
    }

    public function storeItem($data)
    {
        $response = $this->requestService->makeRequest('post', '/items', [
            'name' => $data['name'],
            'tax_id'=>$data['tax_id'],
            'vendor_id'=>$data['vendor_id'],
            'rate'=>$data['rate'],
            'initial_stock'=>$data['initial_stock'],
            'initial_stock_rate'=>$data['initial_stock_rate'],
            'item_type'=>'inventory',
            'purchase_rate'=>$data['purchase_rate']
        ]);

        return $response;
    }
}
