<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SapMercanciaController extends Controller
{
    public function SapSetMercanciaByOC(Request $request)
    {
        $client = new Client([
            'base_uri'  => 'http://172.20.6.54/'
        ]);

        $array_rpta = [];
        $rptaSap   = [];

        $User       =   Auth::user()->id;
        $cCardCode   =   'C'.$User;

        $data = $request->data;
        foreach ($data as $key => $value) {
            $json = [
                'json' => [
                    "CardCode"      => $cCardCode,
                    //"DocDate"       => (string)$request->fDocDate,
                    //"DocDueDate"    => (string)$request->fDocDueDate,
                    "DocumentLines" => [
                            [
                                "BaseType"    => "22",
                                "BaseEntry"    => (string)$value['nDocEntry'],
                                "BaseLine"     => "0"
                            ]
                        ]
                    ]
                ];

            $response = $client->request('POST', "/Sap/api/Mercancia/SapSetMercanciaByOC/", $json);
            $rptaSap = json_decode($response->getBody());
            array_push($array_rpta, $rptaSap);
        }
        return $array_rpta;
    }
}
