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
            'verify'    => false,
            'base_uri'  => 'http://172.20.0.10/'
        ]);

        $array_rpta = [];
        $rptaSap   = [];

        $data = $request->data;
        foreach ($data as $key => $value) {
            $json = [
                'json' => [
                    "CardCode"      => $request->cCardCode,
                    "DocDate"       => (string)$request->fDocDate,
                    "DocumentLines" => [
                            [
                                "BaseType"     => "17",
                                "BaseEntry"    => $value['nDocEntry'],
                                "BaseLine"     => "0",
                                "LineTotal"    => $value['nDocEntry']
                            ]
                        ]
                    ]
                ];

            $response = $client->request('POST', "/api/Comprobante/SapSetFactura/", $json);
            $rptaSap = json_decode($response->getBody());
            array_push($array_rpta, $rptaSap);
        }
        return $array_rpta;
    }

    public function SapSetFacturaProveedorWO(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => 'http://172.20.0.10/'
        ]);

        $array_rpta = [];
        $rptaSap   = [];

        $data = $request->data;
        foreach ($data as $key => $value) {
            $json = [
                'json' => [
                    "CardCode"      => $request->cCardCode,
                    "DocDate"       => (string)$request->fDocDate,
                    "DocCurrency"   =>  "US$",
                    "DocType"       => "dDocument_Service",
                    "DocumentLines" => [
                            [
                                "ItemDescription"   => "Servicio WO - ".$value['cNumeroVin'],
                                "TaxCode"           => "EXE_IGV",
                                "PriceAfterVAT"     => $value['fTotalCompra'],
                                "Currency"          => "US$",
                                "AccountCode"       => (string)$value['cAccountCode'],
                                //"WarehouseCode"     => (string)$request->cWarehouseCode,
                                "ProjectCode"       => (string)$value['cNumeroVin']
                            ]
                        ]
                    ]
                ];

            $response = $client->request('POST', "/api/Comprobante/SapSetFacturaProveedor/", $json);
            $rptaSap = json_decode($response->getBody());
            array_push($array_rpta, $rptaSap);
        }
        return $array_rpta;
    }

    public function SapSetFacturaProveedorWF(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => 'http://172.20.0.10/'
        ]);

        $array_rpta = [];
        $rptaSap   = [];

        $data = $request->data;
        foreach ($data as $key => $value) {
            $json = [
                'json' => [
                    "CardCode"      => $request->cCardCode,
                    "DocDate"       => (string)$request->fDocDate,
                    "DocCurrency"   =>  "US$",
                    "DocType"       => "dDocument_Service",
                    "DocumentLines" => [
                            [
                                "ItemDescription"   => "Servicio WF - ".$value['cNumeroVin'],
                                "TaxCode"           => "EXE_IGV",
                                "PriceAfterVAT"     => $value['fTotalCompra'],
                                "Currency"          => "US$",
                                "AccountCode"       => (string)$value['cAccountCode'],
                                "ProjectCode"       => (string)$value['cNumeroVin']
                            ]
                        ]
                    ]
                ];

            $response = $client->request('POST', "/api/Comprobante/SapSetFacturaProveedor/", $json);
            $rptaSap = json_decode($response->getBody());
            array_push($array_rpta, $rptaSap);
        }
        return $array_rpta;
    }
}
