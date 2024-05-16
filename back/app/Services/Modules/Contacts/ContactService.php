<?php

namespace App\Services\Modules\Contacts;

use App\Services\Helpers\RequestService;

class ContactService
{
    public function __construct(private RequestService $requestService) {}

    public function storeContact($data)
    {
        $url = 'https://www.zohoapis.eu/inventory/v1/contacts';

        $response = $this->requestService->makeRequest('post', $url, [
            'contact_name' => $data['contact_name'],
            'contact_type' => $data['contact_type'],
        ]);

        return $response;
    }

    public function getContacts()
    {
        $url = 'https://www.zohoapis.eu/inventory/v1/contacts';

        $response = $this->requestService->makeRequest('get', $url);

        return $response['contacts'];
    }
}
