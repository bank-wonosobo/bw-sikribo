<?php

namespace App\Helper;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthUser
{
    public static function user()
    {
        $token = session('access_token');

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ])->get(env('URL_OAUTH'). '/api/current');

        // dd($token);
        // dd($response->body());
        $user = "";
        if ($response->status() == 401) {
            $user = null;
        } else {
            $user = (object) $response->json()[0];
        }

        return $user;
    }

    public static function accessToken()
    {
        return Session::get('access_token');
    }
}
