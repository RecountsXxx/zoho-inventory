<?php

namespace App\Services\Modules\Customers;

use App\Services\Helpers\RequestService;

class VendorService
{
    public function __construct(private RequestService $requestService){}

    public function getVendors()
    {
        $url = 'https://www.zohoapis.eu/inventory/v1/vendors';

        $response = $this->requestService->makeRequest('get',$url);

        return $response['contacts'];
    }
}
