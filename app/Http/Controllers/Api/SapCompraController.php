<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SapCompraController extends Controller
{
    public function GetListComprasByIdAPI()
    {
        $client = new Client([
            'base_uri' => 'http://172.20.6.54/',// URI Ejem: https://jsonplaceholder.typicode.com
        ]);

        $response = $client->request('GET', "/Sap/api/Compra/GetListCompraByVin");

        $posts = json_decode($response->getBody()->getContents());
        return $posts;
    }

    /// ============================================================
    /// METODOS SERVICES LAYER
    /// ============================================================
    /// 
    public function SapSetCompra(Request $request)
    {
        $client = new Client([
            'base_uri'  => 'http://172.20.6.54/'
        ]);
        
        $User = Auth::user()->id;
        $CardCode = 'C'.$User;
        $data = $request->data;

        foreach ($data as $key => $value) {
            $dataArray = [ "ItemCode" => 'ITEM001',
                    'Quantity' => '20',
                    'TaxCode' => 'IGV',
                    'UnitPrice' => '2'
                ];

            foreach ($dataArray as $keyArray => $valueArray) {
                    $arrayResult[$keyArray] = $valueArray;
                }
        }

        /*
        $data = [
            "ItemCode" => $request->ItemCode,
            "Quantity" => $request->Quantity,
            "TaxCode" => $request->TaxCode,
            "UnitPrice" => $request->UnitPrice
        ];
        */

        /*$arrayResult= [];
        foreach ($data as $key => $value) {
            $arrayResult[$key] = $value;
        }*/

        $json = [
            'json' => [
                "CardCode" => $CardCode,
                "DocDate" => "2018-11-30",
                "DocDueDate" => "2018-12-04",
                "DocumentLines" => [
                        $arrayResult
                    ]
                ]
           ];

        //return $json;
        $response = $client->request('POST', "/Sap/api/Compra/SapSetCompra/", $json);
        return $response->getBody();
    }
}
