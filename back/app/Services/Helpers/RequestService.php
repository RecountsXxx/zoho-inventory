<?php
namespace App\Services\Helpers;

use App\Services\Abstracts\AbstractRequestService;
use Illuminate\Http\Client\Response;

class RequestService extends AbstractRequestService
{
    public function makeRequest(string $method, string $endpoint, array $data = []): Response
    {
        return $this
            ->setMethod($method)
            ->setEndpoint($endpoint)
            ->setData($data)
            ->sendRequest();
    }
}
