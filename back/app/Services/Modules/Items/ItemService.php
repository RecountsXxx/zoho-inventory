<?php

namespace App\Services\Modules\Items;

use App\Services\Helpers\RequestService;

class ItemService
{
    public function __construct(private RequestService $requestService) {}

    public function getItems()
    {
        $url = 'https://www.zohoapis.eu/inventory/v1/items';

        $response = $this->requestService->makeRequest('get',$url);

        return $response['items'];
    }

    public function getItem(string $id)
    {
        $url = 'https://www.zohoapis.eu/inventory/v1/items/' . $id;

        $response = $this->requestService->makeRequest('get',$url);

        return $response['item'];
    }

    public function storeItem($data)
    {
        $url = 'https://www.zohoapis.eu/inventory/v1/items';

        $response = $this->requestService->makeRequest('post', $url, [
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
