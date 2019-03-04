<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
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
            'verify'    => false,
            'base_uri'  => 'http://172.20.0.10/'
        ]);

        $data = DB::select('exec [usp_Usuario_GetEmpleadoByUsuario] ?',
                                                    [
                                                        Auth::user()->id
                                                    ]);
        // Obtener el EmployeeCode del Usuario Autenticado
        $nSalesEmployeeCode   =   $data[0]->nSalesEmployeeCode;

        $array_rpta = [];
        $rptaSap   = [];
        $ReceptionDate              =   date('Y-m-d');

        $data = $request->data;
        foreach ($data as $key => $value) {
            $SubTotal = (floatval($value['fTotalCompra']) / floatval($request->Igv));

            $json = [
                'json' => [
                    "CardCode"          =>  $request->cCardCode,
                    "DocDate"           =>  (string)$request->fDocDate,
                    "DocDueDate"        =>  (string)$request->fDocDueDate,
                    "DocCurrency"       =>  "US$",
                    "DocTotal"          =>  (string)$value['fTotalCompra'],
                    "SalesPersonCode"   =>  (string)$nSalesEmployeeCode,
                    "DocumentLines" => [
                            [
                                "ItemCode"    => (string)$value['cNumeroVin'],
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
        }
        return $array_rpta;
    }
}
