<?php

use App\Services\Helpers\AccessTokenService;
use Illuminate\Support\Facades\Route;

Route::get('/access-token', function () {
  dd(AccessTokenService::class::getAccessToken());
});
