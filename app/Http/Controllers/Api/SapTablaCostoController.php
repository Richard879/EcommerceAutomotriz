<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SapTablaCostoController extends Controller
{
    public function SapSetTablaCostoCabecera(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => 'http://172.20.0.10/'
        ]);

        $array_rpta = [];
        $rptaSap   = [];

        $data = $request->data;
        foreach ($data as $key => $cabecera) {
            $json = [
                'json' => [
                    "U_SYP_VIN" => (string)$cabecera['cNumeroVin']
                ]
            ];

            $response = $client->request('POST', "/api/TablaCosto/SetCabeceraTablaCosto/", $json);
            $rptaSap = json_decode($response->getBody());
            array_push($array_rpta, $rptaSap);
        }
        return $array_rpta;
    }

    public function SapSetTablaCostoDetalleCabecera(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => 'http://172.20.0.10/'
        ]);

        $array_rptaCabecera = [];
        $array_rptaBeneficio = [];
        $array_rptaCostoVehiculo = [];
        $array_rptaFlete = [];

        $arrayCabeceraTblCost = $request->arrayCabeceraTblCost;
        foreach ($arrayCabeceraTblCost as $key => $cabecera) {
            //OBTENER EL VIN PARA COMPARAR CON LOS CONCEPTOS (BENEFICIO,COSTO VEHÍCULO, FLETE) Y DOCENTRY PARA REFERENCIARLOS
            $TblCostoDocEntry   =   $cabecera['DocEntry'];
            $TblCostoVIN        =   $cabecera['U_SYP_VIN'];

            // ====================================================================================================
            // =========================  REGISTRAR DETALLE CABECERA TBL COST - BENEFICIO =========================
            $arrayTipoBeneficio = $request->arrayTipoBeneficio;
            foreach ($arrayTipoBeneficio as $key => $beneficio) {
                //Verifica que el VIN de ese Beneficio sea Igual al VIN de la Cabecera Costo, para que se le asigne
                if ($TblCostoVIN == $beneficio['U_SYP_VIN']) {
                    $json = [
                        'json' => [
                            "DocEntry"          => (string)$TblCostoDocEntry,
                            "U_SYP_CCONCEPTO"   => (string)$beneficio['U_SYP_CCONCEPTO'],
                            "U_SYP_DCONCEPTO"   => (string)$beneficio['U_SYP_DCONCEPTO'],
                            "U_SYP_CDOCUMENTO"  => (string)$beneficio['U_SYP_CDOCUMENTO'],
                            "U_SYP_DDOCUMENTO"  => (string)$beneficio['U_SYP_DDOCUMENTO'],
                            "U_SYP_IMPORTE"     => (string)$beneficio['U_SYP_IMPORTE'],
                            "U_SYP_COSTO"       => (string)$beneficio['U_SYP_COSTO'],
                            "U_SYP_ESTADO"      => (string)$beneficio['U_SYP_ESTADO']
                        ]
                    ];

                    $rptaBeneficio = $client->request('POST', "/api/TablaCosto/SetUpdDetalleCabeceraTablaCosto/", $json);
                    $rptaSapBeneficio = json_decode($rptaBeneficio->getBody());
                    array_push($array_rptaBeneficio, $rptaSapBeneficio);
                }

            }

            // ====================================================================================================
            // ======================  REGISTRAR DETALLE CABECERA TBL COST - COSTO VEHÍCULO =======================
            $arrayTCCostoVehiculo = $request->arrayTCCostoVehiculo;
            foreach ($arrayTCCostoVehiculo as $key => $costovehiculo) {
                //Verifica que el VIN de ese Costo de Vehículo sea Igual al VIN de la Cabecera Costo, para que se le asigne
                if ($TblCostoVIN == $costovehiculo['U_SYP_VIN']) {
                    $json = [
                        'json' => [
                            "DocEntry"          => (string)$TblCostoDocEntry,
                            "U_SYP_CCONCEPTO"   => (string)$costovehiculo['U_SYP_CCONCEPTO'],
                            "U_SYP_DCONCEPTO"   => (string)$costovehiculo['U_SYP_DCONCEPTO'],
                            "U_SYP_CDOCUMENTO"  => (string)$costovehiculo['U_SYP_CDOCUMENTO'],
                            "U_SYP_DDOCUMENTO"  => (string)$costovehiculo['U_SYP_DDOCUMENTO'],
                            "U_SYP_IMPORTE"     => (string)$costovehiculo['U_SYP_IMPORTE'],
                            "U_SYP_COSTO"       => (string)$costovehiculo['U_SYP_COSTO'],
                            "U_SYP_ESTADO"      => (string)$costovehiculo['U_SYP_ESTADO']
                        ]
                    ];

                    $rptaCostoVehiculo = $client->request('POST', "/api/TablaCosto/SetUpdDetalleCabeceraTablaCosto/", $json);
                    $rptaSAPCostoVehiculo = json_decode($rptaCostoVehiculo->getBody());
                    array_push($array_rptaCostoVehiculo, $rptaSAPCostoVehiculo);
                }
            }

            // ====================================================================================================
            // ==========================  REGISTRAR DETALLE CABECERA TBL COST - FLETE ============================
            $arrayTCFlete = $request->arrayTCFlete;
            foreach ($arrayTCFlete as $key => $flete) {
                //Verifica que el VIN de ese Flete sea Igual al VIN de la Cabecera Costo, para que se le asigne
                if ($TblCostoVIN == $flete['U_SYP_VIN']) {
                    $json = [
                        'json' => [
                            "DocEntry"          => (string)$TblCostoDocEntry,
                            "U_SYP_CCONCEPTO"   => (string)$flete['U_SYP_CCONCEPTO'],
                            "U_SYP_DCONCEPTO"   => (string)$flete['U_SYP_DCONCEPTO'],
                            "U_SYP_CDOCUMENTO"  => (string)$flete['U_SYP_CDOCUMENTO'],
                            "U_SYP_DDOCUMENTO"  => (string)$flete['U_SYP_DDOCUMENTO'],
                            "U_SYP_IMPORTE"     => (string)$flete['U_SYP_IMPORTE'],
                            "U_SYP_COSTO"       => (string)$flete['U_SYP_COSTO'],
                            "U_SYP_ESTADO"      => (string)$flete['U_SYP_ESTADO']
                        ]
                    ];

                    $rptaFlete = $client->request('POST', "/api/TablaCosto/SetUpdDetalleCabeceraTablaCosto/", $json);
                    $rptaSapFlete = json_decode($rptaFlete->getBody());
                    array_push($array_rptaFlete, $rptaSapFlete);
                }
            }
        }

        $rpta = [
            'array_rptaCabecera'        =>  $array_rptaCabecera,
            'array_rptaBeneficio'       =>  $array_rptaBeneficio,
            'array_rptaCostoVehiculo'   =>  $array_rptaCostoVehiculo,
            'array_rptaFlete'           =>  $array_rptaFlete
        ];

        return $rpta;
    }
}
