<?php

namespace App\Services\Modules\Items;

use App\Services\Helpers\RequestService;

class TaxService
{
    public function __construct(private RequestService $requestService){}

    public function storeTax($data)
    {
        $url = 'https://www.zohoapis.eu/inventory/v1/settings/taxes';

        $response = $this->requestService->makeRequest('post', $url, [
            'tax_name' => $data['tax_name'],
            'tax_percentage'=>$data['tax_percentage'],
        ]);

        return $response;
    }
    public function getTaxs()
    {
        $url = 'https://www.zohoapis.eu/inventory/v1/settings/taxes';

        $response = $this->requestService->makeRequest('get',$url);

        return $response['taxes'];
    }
}
