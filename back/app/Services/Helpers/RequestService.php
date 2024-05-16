<?php

namespace App\Services\Helpers;

use Illuminate\Support\Facades\Http;

class RequestService
{
    public function makeRequest($method, $url, $data = [])
    {
        $accessToken = AccessTokenService::getAccessToken();

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json'
        ])->$method($url, $data);

        return $response;
    }
}
