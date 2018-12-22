<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SapComprobanteController extends Controller
{
    public function SapSetFactura(Request $request)
    {
        $client = new Client([
            'base_uri'  => 'http://172.20.6.68/'
        ]);

        $array_rpta = [];
        $rptaSap   = [];

        $data = $request->data;
        foreach ($data as $key => $value) {
            $json = [
                'json' => [
                    "CardCode"      => $request->cCardCode,
                    "DocDate"       => "2018-11-30",
                    "DocumentLines" => [
                            [
                                "BaseType"    => "17",
                                "BaseEntry"    => $value['nDocEntry'],
                                "BaseLine"     => "0"
                            ]
                        ]
                    ]
                ];

            $response = $client->request('POST', "/Sap/api/Factura/SapSetFactura/", $json);
            $rptaSap = json_decode($response->getBody());
            array_push($array_rpta, $rptaSap);
        }
        return $array_rpta;
    }
}
