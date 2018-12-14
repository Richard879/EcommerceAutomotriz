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
            'base_uri'  => 'http://172.20.6.59/'
        ]);

        $array_rpta = [];
        $DocEntry   = [];

        $User       = Auth::user()->id;
        $CardCode   = 'C'.$User;

        $data = $request->data;
        foreach ($data as $key => $value) {
            $dataArray = [
                    'ItemCode'  => 'ITEM001',
                    'Quantity'  => '1',
                    'TaxCode'   => 'IGV',
                    'UnitPrice' => '100'
                ];

            /*foreach ($dataArray as $keyArray => $valueArray) {
                    $arrayResult[$keyArray] = $valueArray;
                }*/

            $json = [
                'json' => [
                    "CardCode"      => $CardCode,
                    "DocDate"       => "2018-11-30",
                    "DocDueDate"    => "2018-12-04",
                    "DocumentLines" => [
                            $dataArray
                        ]
                    ]
                ];

            $response = $client->request('POST', "/Sap/api/Compra/SapSetCompra/", $json);
            $DocEntry = json_decode($response->getBody());
            array_push($array_rpta, $DocEntry);
        }
        return $array_rpta;
    }
}
