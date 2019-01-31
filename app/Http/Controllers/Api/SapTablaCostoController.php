<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SapTablaCostoController extends Controller
{
    public function SapSetCabeceraTablaCosto(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => 'http://172.20.0.10/'
        ]);

        $array_rptaCabecera = [];
        $rptaSapCabecera   = [];
        $array_rptaDealleCabecera = [];
        $rptaSapDetalleCabecera   = [];

        $arrayCabeceraTblCost = $request->arrayCabeceraTblCost;
        foreach ($arrayCabeceraTblCost as $key => $cabecera) {

            $cabecaraTblCosto = $cabecera['U_SYP_VIN'];

            $json = [
                'json' => [
                    "U_SYP_VIN" => (string)$cabecera['U_SYP_VIN'],
                ]
            ];

            $response = $client->request('POST', "/api/TablaCosto/SetCabeceraTablaCosto/", $json);
            $rptaSapCabecera = json_decode($response->getBody());
            array_push($array_rptaCabecera, $rptaSapCabecera);

            $arrayDetalleCabeceraTblCost = $request->arrayDetalleCabeceraTblCost;
            foreach ($arrayDetalleCabeceraTblCost as $key => $detalle) {
                $json = [
                    'json' => [
                        "U_SYP_VIN"         => (string)$cabecaraTblCosto,
                        "U_SYP_CCONCEPTO"   => (string)$detalle['U_SYP_CCONCEPTO'],
                        "U_SYP_DCONCEPTO"   => (string)$detalle['U_SYP_DCONCEPTO'],
                        "U_SYP_CDOCUMENTO"  => (string)$detalle['U_SYP_CDOCUMENTO'],
                        "U_SYP_DDOCUMENTO"  => (string)$detalle['U_SYP_DDOCUMENTO'],
                        "U_SYP_IMPORTE"     => (string)$detalle['U_SYP_IMPORTE'],
                        "U_SYP_COSTO"       => (string)$detalle['U_SYP_COSTO'],
                        "U_SYP_ESTADO"      => (string)$detalle['U_SYP_ESTADO']
                    ]
                ];

                $response = $client->request('POST', "/api/TablaCosto/SetDetalleCabeceraTablaCosto/", $json);
                $rptaSapDetalleCabecera = json_decode($response->getBody());
                array_push($array_rptaDealleCabecera, $rptaSapDetalleCabecera);
            }
        }

        $rpta = [
            'array_rptaCabecera'        => $array_rptaCabecera,
            'array_rptaDealleCabecera'  => $array_rptaDealleCabecera
        ];

        return $rpta;
    }
}
