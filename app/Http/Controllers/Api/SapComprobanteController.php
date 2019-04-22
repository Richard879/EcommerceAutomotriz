<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
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

        //Obtener Cuenta Asociada
        $dataCcAsociada = DB::select('exec [usp_TipoPar_GetTipoByIdParametro] ?, ?, ?',
                                                            [   1300528,
                                                                '',
                                                                72
                                                            ]);
        $cCuentaAsociada   =   $dataCcAsociada[0]->cDatoParDescripcion;

        //Obtener Cuenta Puente Asiento Contable
        $dataCServicio = DB::select('exec [usp_TipoPar_GetTipoByIdParametro] ?, ?, ?',
                                                            [   1300528,
                                                                '',
                                                                66
                                                            ]);
        $cAccountCode   =   $dataCServicio[0]->cDatoParDescripcion;

        $data = $request->data;
        foreach ($data as $key => $value) {
            $json = [
                'json' => [
                    "CardCode"      =>  $request->cCardCode,
                    "DocDate"       =>  (string)$request->fDocDate,
                    "DocDueDate"    =>  (string)$request->fDocDueDate,
                    "DocCurrency"   =>  "US$",
                    "DocRate"       =>  $value['fDocRate'],
                    "DocType"       =>  "dDocument_Service",
                    "U_SYP_MDMT"    =>  "01",
                    "U_SYP_MDTD"    =>  "WO",
                    "U_SYP_MDSD"    =>  (string)$value['cSerieComprobante'],
                    "U_SYP_MDCD"    =>  (string)$value['cNumeroComprobante'],
                    "DocumentLines" =>  [
                        [
                            "ItemDescription"   =>  "Warrant Operativo - ".$value['cNumeroVin'],
                            "TaxCode"           =>  "EXE_IGV",
                            "PriceAfterVAT"     =>  $value['fTotalCompra'],
                            "Currency"          =>  "US$",
                            "AccountCode"       =>  (string)$cAccountCode,
                            //"WarehouseCode"     => (string)$request->cWarehouseCode,
                            "ProjectCode"       =>  (string)$value['cNumeroVin']
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

        $data = DB::select('exec [usp_TipoPar_GetTipoByIdParametro] ?, ?, ?',
                                                            [   1300529,
                                                                '',
                                                                70
                                                            ]);
        //Obtener Cuenta Servicio
        $cAccountCode   =   $data[0]->cDatoParDescripcion;

        $data = $request->data;
        foreach ($data as $key => $value) {
            $json = [
                'json' => [
                    "CardCode"      => $request->cCardCode,
                    "DocDate"       => (string)$request->fDocDate,
                    "DocDueDate"    =>  (string)$request->fDocDueDate,
                    "DocCurrency"   => "US$",
                    "DocType"       => "dDocument_Service",
                    "U_SYP_MDMT"    => "01",
                    "U_SYP_MDTD"    => "WF",
                    "DocumentLines" => [
                            [
                                "ItemDescription"   => "Servicio WF - ".$value['cNumeroVin'],
                                "TaxCode"           => "EXE_IGV",
                                "PriceAfterVAT"     => $value['fTotalCompra'],
                                "Currency"          => "US$",
                                "AccountCode"       => (string)$cAccountCode,
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

    public function SapGetComprobanteByTipo(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => 'http://172.20.0.10/'
        ]);

        $array_rpta = [];
        $rptaSap   = [];

        $arrayData = $request->data;
        foreach ($arrayData as $key => $value) {

            $nBaseEntry = $value['nBaseEntry'];
            $nBaseType  = $value['nBaseType'];
            $cItemCode  = $value['cItemCode'];

            $response = $client->request('POST', "/api/Comprobante/SapGetComprobanteByTipo/", [
                                                                                        'query' => ['nBaseEntry' => $nBaseEntry,
                                                                                                    'nBaseType' => $nBaseType,
                                                                                                    'cItemCode' => $cItemCode]
                                                                                    ]);
            $rptaSap = json_decode($response->getBody());
        }
        return $rptaSap;
    }
}
