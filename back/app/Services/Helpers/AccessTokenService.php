<?php

namespace App\Services\Helpers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class AccessTokenService
{
    public static function getAccessToken()
    {
        $clientId = env("ZOHO_CLIENT_ID");
        $clientSecret = env("ZOHO_CLIENT_SECRET");
        $accountUrl = env("ZOHO_ACCOUNT_URL");
        $code = env("ZOHO_CLIENT_CODE");

        $accessToken = Cache::get('zoho_access_token');
        $refreshToken = Cache::get('zoho_refresh_token');

        if (!$accessToken || !$refreshToken || self::isAccessTokenExpired($accessToken)) {
            $client = new Client();

            if (self::isAccessTokenExpired($accessToken) && $refreshToken) {
                $response = $client->post($accountUrl . '/oauth/v2/token', [
                    'form_params' => [
                        'refresh_token' => $refreshToken,
                        'client_id' => $clientId,
                        'client_secret' => $clientSecret,
                        'grant_type' => 'refresh_token',
                        'redirect_uri'=>'http://localhost:8080/'
                        ]
                ]);
            } else {
                $response = $client->post($accountUrl . '/oauth/v2/token', [
                    'form_params' => [
                        'code' => $code,
                        'client_id' => $clientId,
                        'client_secret' => $clientSecret,
                        'grant_type' => 'authorization_code',
                        'redirect_uri'=>'http://localhost:8080/'
                    ]
                ]);
            }

            $tokens = json_decode($response->getBody()->getContents(), true);

            if (isset($tokens['access_token'])) {
                $accessToken = [
                    'access_token' => $tokens['access_token'],
                    'expires_in' => time() + $tokens['expires_in']
                ];
                Cache::put('zoho_access_token', $accessToken, $tokens['expires_in']);

                if (isset($tokens['refresh_token'])) {
                    Cache::put('zoho_refresh_token', $tokens['refresh_token']);
                }
            }
            else if (isset($tokens['refresh_token'])) {
                Cache::put('zoho_refresh_token', $tokens['refresh_token']);
            }

            return $tokens['access_token'];
        }
        return $accessToken['access_token'];
    }

    public static function isAccessTokenExpired($accessToken)
    {
        if (isset($accessToken['expires_in'])) {
            $expireTime = $accessToken['expires_in'];
            return $expireTime <= time();
        }
        return true;
    }


}
