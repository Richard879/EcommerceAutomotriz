<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SapUbigeoController extends Controller
{
    public function SapGetUbigeo(Request $request)
    {
        $client = new Client([
            'base_uri'  => 'http://172.20.0.10/'
        ]);

        $json = [
                    'json' => [
                        "ItemCode"    => $request->cNumeroVin
                        ]
                ];

        $response = $client->request('GET', "/api/Ubigeo/GetUbigeo/");
        return $response->getBody();
    }

}
