<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SapCompraController extends Controller
{
    /*public function GetListComprasByIdAPI()
    {
        $client = new Client([
            'base_uri' => 'http://172.20.6.54/',// URI Ejem: https://jsonplaceholder.typicode.com
        ]);

        $response = $client->request('GET', "/Sap/api/Compra/GetListCompraByVin");

        $posts = json_decode($response->getBody()->getContents());
        return $posts;
    }*/

    ////=================== SERVER PUBLISH =====================
    //'base_uri' => 'http://172.20.0.10/'
    //$response = $client->request('POST', "/api/Compra/SapSetCompra", $json);
    ////=================== LOCAL SERVER =====================
    //'base_uri' => 'http://172.20.6.55/'
    //$response = $client->request('POST', "/Sap/api/Compra/SapSetCompra/", $json);
    ////=================== LOCAL DEBUG =====================
    //'base_uri' => 'http://localhost:49454/'
    //$response = $client->request('POST', "/api/Compra/SapSetCompra/", $json);

    /// ============================================================
    /// METODOS SERVICES LAYER
    /// ============================================================
    ///
    public function SapSetCompra(Request $request)
    {
        $client = new Client([
            'base_uri'  => 'http://localhost:49454/'
        ]);

        $array_rpta = [];
        $rptaSap   = [];
        //$DocEntry   = [];

        /*$User       =   Auth::user()->id;
        $cCardCode   =   'C'.$User;*/

        $data = $request->data;
        foreach ($data as $key => $value) {
            /*$dataArray = [
                    "ItemCode"    => $value['cNumeroVin'],
                    "Quantity"    => "1",
                    "TaxCode"     => "IGV",
                    "UnitPrice"   => (string)$value['fTotalCompra']
                ];*/

            /*foreach ($dataArray as $keyArray => $valueArray) {
                    $arrayResult[$keyArray] = $valueArray;
                }*/
            
            $SubTotal = (floatval($value['fTotalCompra']) / floatval($request->Igv));

            $json = [
                'json' => [
                    "CardCode"      => $request->cCardCode,
                    "DocDate"       => (string)$request->fDocDate,
                    "DocDueDate"    => (string)$request->fDocDueDate,
                    "DocCurrency"   => "US$",
                    "DocTotal"      => (string)$value['fTotalCompra'],
                    "DocumentLines" => [
                            [
                                "ItemCode"    => $value['cNumeroVin'],
                                "Quantity"    => "1",
                                "TaxCode"     => "IGV",
                                "UnitPrice"   => (string)$SubTotal,
                                "Currency"    => "US$",
                                "WarehouseCode" =>(string)$request->WarehouseCode
                            ]
                        ]
                    ]
                ];

            $response = $client->request('POST', "/api/Compra/SapSetCompra/", $json);
            $rptaSap = json_decode($response->getBody());
            array_push($array_rpta, $rptaSap);
            /*$DocEntry = json_decode($response->getBody());
            array_push($array_rpta, $DocEntry);*/
        }
        return $array_rpta;
    }

    /*public function SapSetArticulo(Request $request)
    {
        $client = new Client([
            'base_uri'  => 'http://172.20.0.10/'
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

            $response = $client->request('POST', "/api/Articulo/SapSetArticulo/", $json);
            $rptaSap = json_decode($response->getBody());
            array_push($array_rpta, $rptaSap);
        }
        return $array_rpta;
    }*/
}
