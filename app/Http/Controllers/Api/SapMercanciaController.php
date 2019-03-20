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
            'verify'    => false,
            'base_uri'  => 'http://172.20.0.10/'
        ]);

        $array_rpta = [];
        $rptaSap   = [];

        //DATOS DE PRUEBA
        $ReceptionDate              =   date('Y-m-d');

        $data = $request->data;
        foreach ($data as $key => $value) {
            $json = [
                'json' => [
                    "CardCode"      => (string)$value['cCardCode'],
                    "DocDate"       => (string)$request->fDocDate,
                    "DocDueDate"    => (string)$request->fDocDueDate,
                    "U_SYP_MDMT"    =>  "01",
                    "U_SYP_MDTD"    =>  "01",
                    "U_SYP_MDSD"    =>  (string)$value['cSerieComprobante'],
                    "U_SYP_MDCD"    =>  (string)$value['cNumeroComprobante'],
                    "U_SYP_TCOMPRA" =>  "01",
                    "DocumentLines" => [
                        [
                            "BaseType"      =>  "22", //PurchaseOrder
                            "BaseEntry"     =>  (string)$value['nDocEntry'], //DocEntry PurchaseOrder
                            "SerialNumbers" => [
                                [
                                    "ManufacturerSerialNumber"  =>  (string)$value['cNumeroVin'],
                                    "InternalSerialNumber"      =>  (string)$value['cNumeroVin'],
                                    "ExpiryDate"                =>  null,
                                    "ManufactureDate"           =>  null,
                                    "ReceptionDate"             =>  $ReceptionDate,
                                    "WarrantyStart"             =>  null,
                                    "WarrantyEnd"               =>  null,
                                    "Location"                  =>  null,
                                    "Notes"                     =>  null,
                                    "BatchID"                   =>  null,
                                    "SystemSerialNumber"        =>  1,
                                    "BaseLineNumber"            =>  0,
                                    "Quantity"                  =>  1,
                                    "TrackingNote"              =>  null,
                                    "TrackingNoteLine"          =>  null
                                ]
                            ]
                        ]
                    ]
                ]
            ];

            $response = $client->request('POST', "/api/Mercancia/SapSetMercanciaByOC/", $json);
            $rptaSap = json_decode($response->getBody());
            array_push($array_rpta, $rptaSap);
        }
        return $array_rpta;
    }

    public function SapSetMercanciaEntry(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => 'http://172.20.0.10/'
        ]);

        $json = [
            'json' => [
                'DocDate'       =>  (string)$request->fDocDate,
                'DocDueDate'    =>  (string)$request->fDocDueDate,
                "DocumentLines" =>  array()
            ]
        ];

        //Inicializo el contador de la linea
        $cont = 0;

        $dataLength = sizeof($request->data);
        if($dataLength > 0) {
            $data = $request->data;
            foreach ($data as $key => $value) {
                $json['json']['DocumentLines'][] = [
                    //'LineNum'           =>  $cont,
                    "ItemCode"          =>  (string)$value['ItemCode'],
                    //"ItemDescription"   =>  (string)$value['ItemDescription'],
                    "WarehouseCode"     =>  (string)$value['WarehouseCode'],
                    "Quantity"          =>  (string)$value['Quantity'],
                    "UnitPrice"         =>  (string)$value['UnitPrice'],
                    "AccountCode"       =>  (string)$value['AccountCode']
                ];
                $cont++;//Aumento Linea
            }
        }

        $array_rpta = [];
        $rptaSap   = [];

        $response = $client->request('POST', "/api/Mercancia/SapSetMercanciaEntry/", $json);
        $rptaSap = json_decode($response->getBody());
        array_push($array_rpta, $rptaSap);
        return $array_rpta;
    }

    public function SapSetMercanciaExit(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => 'http://172.20.0.10/'
        ]);

        $array_rpta = [];
        $rptaSap   = [];

        $json = [
            'json' => [
                'DocDate'       =>  (string)$request->fDocDate,
                'DocDueDate'    =>  (string)$request->fDocDueDate,
                "DocumentLines" =>  array()
            ]
        ];

        //Inicializo el contador de la linea
        $cont = 0;

        $dataLength = sizeof($request->data);
        if($dataLength > 0) {
            $data = $request->data;
            foreach ($data as $key => $value) {
                $json['json']['DocumentLines'][] = [
                    //'LineNum'           =>  $cont,
                    "ItemCode"          =>  (string)$value['ItemCode'],
                    //"ItemDescription"   =>  (string)$value['ItemDescription'],
                    "WarehouseCode"     =>  (string)$value['WarehouseCode'],
                    "Quantity"          =>  (string)$value['Quantity'],
                    "AccountCode"       =>  (string)$value['AccountCode']
                ];
                $cont++;//Aumento Linea
            }
        }

        $response = $client->request('POST', "/api/Mercancia/SapSetMercanciaExit/", $json);
        $rptaSap = json_decode($response->getBody());
        array_push($array_rpta, $rptaSap);
        return $array_rpta;
    }
}
