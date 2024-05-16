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
}
