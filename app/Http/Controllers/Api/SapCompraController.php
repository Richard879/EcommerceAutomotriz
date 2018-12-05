<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

        $data = [
            "ItemCode" => $request->ItemCode,
            "Quantity" => $request->Quantity,
            "TaxCode" => $request->TaxCode,
            "UnitPrice" => $request->UnitPrice
        ];

        $arrayResult= [];
        foreach ($data as $key => $value) {
            $arrayResult[$key] = $value;
        }

        $json = [
            'json' => [
                "CardCode" => $request->CardCode,
                "DocDate" => $request->DocDate,
                "DocDueDate" => $request->DocDueDate,
                "DocumentLines" => [
                        $arrayResult
                    ]
                ]
           ];

        $response = $client->request('POST', "/Sap/api/Compra/SapSetCompra/", $json);
        return $response->getBody();
    }
}
