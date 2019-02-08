<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SapPedidoController extends Controller
{
    public function SapSetPedido(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => 'http://172.20.0.10/'
        ]);

        //Setear arreglos para Pedido (Vehiculo)
        $arrayVehiculo = [];
        $rptaSap   = [];

        $arraySapPedido = $request->arraySapPedido;
        foreach ($arraySapPedido as $key => $value) {

            $SubTotal = (floatval($value['fSubTotalDolares']) / floatval($request->Igv));

            $json = [
                'json' => [
                    "CardCode"      => $value['cCardCode'],
                    "DocDate"       => (string)$request->fDocDate,
                    "DocDueDate"    => (string)$request->fDocDueDate,
                    "DocCurrency"   => "US$",
                    "DocTotal"      => (string)$value['fSubTotalDolares'],
                    "DocumentLines" => [
                            [
                                "ItemCode"    => $value['cNumeroVin'],
                                "Quantity"    => "1",
                                "TaxCode"     => "IGV",
                                "UnitPrice"   => (string)$SubTotal,
                                "Currency"    => "US$"
                            ]
                    ]
                ]
            ];

            $response = $client->request('POST', "/api/Pedido/SapSetPedido/", $json);
            $rptaSap = json_decode($response->getBody());
            array_push($arrayVehiculo, $rptaSap);
        }

        //Setear arreglos para Pedido (Elemento Venta)
        $arrayEV = [];
        $rptaSap   = [];

        $arraySAPEVPedidoLength = sizeof($request->arraySAPEVPedido);
        if($arraySAPEVPedidoLength > 0) {
            $arraySAPEVPedido = $request->arraySAPEVPedido;
            foreach ($arraySAPEVPedido as $key => $value) {

                $SubTotal = (floatval($value['fSubTotalDolares']) / floatval($request->Igv));

                $json = [
                    'json' => [
                        "CardCode"      => $value['cCardCode'],
                        "DocDate"       => (string)$request->fDocDate,
                        "DocDueDate"    => (string)$request->fDocDueDate,
                        "DocCurrency"   => "US$",
                        "DocTotal"      => (string)$value['fSubTotalDolares'],
                        "DocumentLines" => [
                                [
                                    "ItemCode"    => $value['cCodigoERP'],
                                    "Quantity"    => "1",
                                    "TaxCode"     => "IGV",
                                    "UnitPrice"   => (string)$SubTotal,
                                    "Currency"    => "US$"
                                ]
                        ]
                    ]
                ];

                $response = $client->request('POST', "/api/Pedido/SapSetPedido/", $json);
                $rptaSap = json_decode($response->getBody());
                array_push($arrayEV, $rptaSap);
            }
        }
        return [
            'arrayVehiculo' =>  $arrayVehiculo,
            'arrayEV'       =>  $arrayEV
        ];
    }

    public function SapSetPedidoDscto(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            // 'base_uri'  => 'http://localhost:49454/'
            'base_uri'  => 'http://172.20.0.10/'
        ]);

        $nDocEntryPedido    =   $request->nDocEntryPedido;
        $cCardCode          =   $request->cCardCode;
        $cItemCode          =   $request->cItemCode;
        $dMontoNuevoSoles   =   $request->dMontoNuevoSoles;
        $dMontoNuevoSoles   =   round($dMontoNuevoSoles, 2);

        $dFechaModificacion =   $request->dFechaModificacion;

        $json = [
            'json' => [
                "DocEntryPedido"    => (string)$nDocEntryPedido,
                "CardCode"          => (string)$cCardCode,
                "DocTotal"          => (string)$dMontoNuevoSoles,
                "Comments"          => (string)$dFechaModificacion,
            ]
        ];

        $response = $client->request('POST', "/api/Pedido/SapSetPedidoDscto/", $json);
        return $response->getBody();
    }
}
