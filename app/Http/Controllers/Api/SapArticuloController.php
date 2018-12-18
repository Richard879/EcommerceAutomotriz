<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SapArticuloController extends Controller
{
    public function SapGetValidarArticulo(Request $request)
    {
        $client = new Client([
            'base_uri'  => 'http://172.20.0.10/'
        ]);

        $json = [
                    'json' => [
                        "ItemCode"    => $request->cNumeroVin
                        ]
                ];

        $response = $client->request('POST', "/api/Articulo/SapGetValidarArticulo/", $json);
        return $response->getBody();
    }

}
