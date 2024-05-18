<?php

namespace App\Services\Abstracts;

use App\Services\Helpers\AccessTokenService;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

abstract class AbstractRequestService
{
    protected $method;
    protected $endpoint;
    protected $headers = [];
    protected $data = [];

    public function setMethod(string $method): self
    {
        $this->method = $method;
        return $this;
    }

    public function setEndpoint(string $endpoint): self
    {
        $this->endpoint = $endpoint;
        return $this;
    }

    public function addHeader(string $key, string $value): self
    {
        $this->headers[$key] = $value;
        return $this;
    }

    public function setData(array $data): self
    {
        $this->data = $data;
        return $this;
    }

    protected function getAccessToken(): string
    {
        return AccessTokenService::getAccessToken();
    }

    protected function getBaseUrl(): string
    {
        return config('services.api.base_url');
    }

    public function sendRequest(): Response
    {
        $url = $this->getBaseUrl() . $this->endpoint;

        $this->headers['Authorization'] = 'Bearer ' . $this->getAccessToken();
        $this->headers['Content-Type'] = 'application/json';

        $response = Http::withHeaders($this->headers)->{$this->method}($url, $this->data);

        return $response;
    }
}
