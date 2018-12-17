<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SapArticuloController extends Controller
{
    public function SapSetArticulo(Request $request)
    {
        $client = new Client([
            'base_uri'  => 'http://172.20.6.65/'
        ]);

        $array_rpta = [];
        $rptaSap   = [];

        $User       = Auth::user()->id;
        $CardCode   = 'C'.$User;

        $data = $request->data;
        foreach ($data as $key => $value) {
            $json = [
                'json' => [
                    "ItemCode"    => $value['cNumeroVin'],
                    "ItemName"    => $value['cNombreComercial'],
                    "ItemType"    => "itItems"
                    ]
                ];

            $response = $client->request('POST', "/Sap/api/Articulo/SapSetArticulo/", $json);
            $rptaSap = json_decode($response->getBody());
            array_push($array_rpta, $rptaSap);
        }
        return $array_rpta;
    }
}
