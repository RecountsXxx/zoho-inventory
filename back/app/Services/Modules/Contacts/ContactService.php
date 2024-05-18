<?php

namespace App\Services\Modules\Contacts;

use App\Services\Helpers\RequestService;

class ContactService
{
    public function __construct(private RequestService $requestService) {}

    public function storeContact($data)
    {
        $response = $this->requestService->makeRequest('post', '/contacts', [
            'contact_name' => $data['contact_name'],
            'contact_type' => $data['contact_type'],
        ]);

        return $response;
    }

    public function getContacts()
    {
        $response = $this->requestService->makeRequest('get', '/contacts');

        return $response['contacts'];
    }
}
