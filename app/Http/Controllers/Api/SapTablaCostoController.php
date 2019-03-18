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

            $response = $client->request('POST', "/api/TblCosto/SapSetTblCosto/", $json);
            $rptaSap = json_decode($response->getBody());
            array_push($array_rpta, $rptaSap);
        }
        return $array_rpta;
    }

    public function SapPachTablaCostoDetalle(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => 'http://172.20.0.10/'
        ]);

        $array_rptaBeneficio = [];
        $array_rptaCostoVehiculo = [];

        $dataCab = $request->dataCabecera;
        foreach ($dataCab as $key => $cabecera) {
            //OBTENER EL VIN PARA COMPARAR CON LOS CONCEPTOS (BENEFICIO,COSTO VEHÍCULO, FLETE) Y DOCENTRY PARA REFERENCIARLOS
            $TblCostoDocEntry   =   $cabecera['DocEntry'];
            $TblCostoVIN        =   $cabecera['U_SYP_VIN'];

            // ====================================================================================================
            // =========================  REGISTRAR DETALLE CABECERA TBL COST - BENEFICIO =========================
            $arrayTipoBeneficio = sizeof($request->dataTipoBeneficio);
            if($arrayTipoBeneficio > 0) {
                $dataTipoBenef = $request->dataTipoBeneficio;
                foreach ($dataTipoBenef as $key => $beneficio) {
                    //Verifica que el VIN de ese Beneficio sea Igual al VIN de la Cabecera Costo, para que se le asigne al detalle como concepto
                    if ($TblCostoVIN == $beneficio['U_SYP_VIN']) {
                        $json = [
                            'json' => [
                                "U_SYP_VIN"         => (string)$beneficio['U_SYP_VIN'],
                                "DocEntry"          => (string)$TblCostoDocEntry,
                                "SYP_COSTODETCollection" => [
                                    [
                                        "DocEntry"          => (string)$TblCostoDocEntry,
                                        "U_SYP_CCONCEPTO"   => (string)$beneficio['U_SYP_CCONCEPTO'],
                                        "U_SYP_DCONCEPTO"   => (string)$beneficio['U_SYP_DCONCEPTO'],
                                        "U_SYP_CDOCUMENTO"  => (string)$beneficio['U_SYP_CDOCUMENTO'],
                                        "U_SYP_DSDOCUMENTO"  => (string)$beneficio['U_SYP_DDOCUMENTO'],
                                        "U_SYP_IMPORTE"     => (string)$beneficio['U_SYP_IMPORTE'],
                                        "U_SYP_COSTO"       => (string)$beneficio['U_SYP_COSTO'],
                                        "U_SYP_ESTADO"      => (string)$beneficio['U_SYP_ESTADO']
                                    ]
                                ]
                            ]
                        ];

                        $rptaBeneficio = $client->request('POST', "/api/TblCosto/SapPachTblCostoDet/", $json);
                        $rptaSapBeneficio = json_decode($rptaBeneficio->getBody());
                        array_push($array_rptaBeneficio, $rptaSapBeneficio);
                    }

                }
            }

            // ====================================================================================================
            // ======================  REGISTRAR DETALLE CABECERA TBL COST - COSTO VEHÍCULO =======================
            /*$dataCostoVeh = $request->dataCostoVehiculo;
            foreach ($dataCostoVeh as $key => $costovehiculo) {
                //Verifica que el VIN de ese Costo de Vehículo sea Igual al VIN de la Cabecera Costo, para que se le asigne al detalle como concepto
                if ($TblCostoVIN == $costovehiculo['U_SYP_VIN']) {
                    $json = [
                        'json' => [
                            "U_SYP_VIN"         => (string)$costovehiculo['U_SYP_VIN'],
                            "DocEntry"          => (string)$TblCostoDocEntry,
                            "SYP_COSTODETCollection" => [
                                [
                                    "U_SYP_CCONCEPTO"   => (string)$costovehiculo['U_SYP_CCONCEPTO'],
                                    "U_SYP_DCONCEPTO"   => (string)$costovehiculo['U_SYP_DCONCEPTO'],
                                    "U_SYP_CDOCUMENTO"  => (string)$costovehiculo['U_SYP_CDOCUMENTO'],
                                    "U_SYP_DDOCUMENTO"  => (string)$costovehiculo['U_SYP_DDOCUMENTO'],
                                    "U_SYP_IMPORTE"     => (string)$costovehiculo['U_SYP_IMPORTE'],
                                    "U_SYP_COSTO"       => (string)$costovehiculo['U_SYP_COSTO'],
                                    "U_SYP_ESTADO"      => (string)$costovehiculo['U_SYP_ESTADO']
                                ]
                            ]
                        ]
                    ];

                    $rptaCostoVehiculo = $client->request('POST', "/api/TblCosto/SapPachTblCostoDet/", $json);
                    $rptaSAPCostoVehiculo = json_decode($rptaCostoVehiculo->getBody());
                    array_push($array_rptaCostoVehiculo, $rptaSAPCostoVehiculo);
                }
            }*/
        }

        $rpta = [
            'array_rptaBeneficio'       =>  $array_rptaBeneficio/*,
            'array_rptaCostoVehiculo'   =>  $array_rptaCostoVehiculo*/
        ];

        return $rpta;
    }

    public function SapPachTablaCosto(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => 'http://172.20.0.10/'
        ]);

        $array_rpta = [];

        // ====================================================================================================
        // ==========================  REGISTRAR DETALLE CABECERA TBL COST - FLETE ============================
        $data = $request->data;
        foreach ($data as $key => $value) {
            $json = [
                'json' => [
                    "U_SYP_VIN"         => (string)$value['U_SYP_VIN'],
                    "DocEntry"          => (string)$value['DocEntry'],
                    "SYP_COSTODETCollection" => [
                        [
                            "U_SYP_CCONCEPTO"   => (string)$value['U_SYP_CCONCEPTO'],
                            "U_SYP_DCONCEPTO"   => (string)$value['U_SYP_DCONCEPTO'],
                            "U_SYP_CDOCUMENTO"  => (string)$value['U_SYP_CDOCUMENTO'],
                            "U_SYP_DSDOCUMENTO"  => (string)$value['U_SYP_DDOCUMENTO'],
                            "U_SYP_IMPORTE"     => (string)$value['U_SYP_IMPORTE'],
                            "U_SYP_COSTO"       => (string)$value['U_SYP_COSTO'],
                            "U_SYP_ESTADO"      => (string)$value['U_SYP_ESTADO']
                        ]
                    ]
                ]
            ];

            $rpta = $client->request('POST', "/api/TblCosto/SapPachTblCostoDet/", $json);
            $rptaSap = json_decode($rpta->getBody());
            array_push($array_rpta, $rptaSap);
        }

        $rpta = [
            'array_rpta' =>  $array_rpta
        ];

        return $rpta;
    }

    public function SapPachTablaCostoDscto(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => 'http://172.20.0.10/'
        ]);

        // =====================================================================================================
        // ===============  REGISTRAR DETALLE CABECERA TBL COST - NOTA DE CREDITO - PEDIDO DSCTO ===============
        $U_SYP_IMPORTE =   round($request->U_SYP_IMPORTE, 2);

        $json = [
            'json' => [
                "U_SYP_VIN"         => (string)$request->U_SYP_VIN,
                "DocEntry"          => (string)$request->DocEntry,
                "SYP_COSTODETCollection" => [
                    [
                        "U_SYP_CCONCEPTO"   => (string)$request->U_SYP_CCONCEPTO,
                        "U_SYP_DCONCEPTO"   => (string)$request->U_SYP_DCONCEPTO,
                        "U_SYP_CDOCUMENTO"  => (string)$request->U_SYP_CDOCUMENTO,
                        "U_SYP_DSDOCUMENTO"  => (string)$request->U_SYP_DDOCUMENTO,
                        "U_SYP_IMPORTE"     => (string)$U_SYP_IMPORTE,
                        "U_SYP_COSTO"       => (string)$request->U_SYP_COSTO,
                        "U_SYP_ESTADO"      => (string)$request->U_SYP_ESTADO
                    ]
                ]
            ]
        ];

        $response = $client->request('POST', "/api/TblCosto/SapPachTblCostoDet/", $json);
        return $response->getBody();
    }

    public function SapPachTablaCostoDsctoPedidoDscto(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => 'http://172.20.0.10/'
        ]);

        // =====================================================================================================
        // ===============  REGISTRAR DETALLE CABECERA TBL COST - NOTA DE CREDITO - PEDIDO DSCTO ===============
        //Redondea el número a 2 decimales
        $U_SYP_IMPORTE  =   round($request->U_SYP_IMPORTE, 2);
        //Convierte en negativo el número
        $U_SYP_IMPORTE  =   gmp_neg($U_SYP_IMPORTE);

        $json = [
            'json' => [
                "U_SYP_VIN"         => (string)$request->U_SYP_VIN,
                "DocEntry"          => (string)$request->DocEntry,
                "SYP_COSTODETCollection" => [
                    [
                        "U_SYP_CCONCEPTO"   => (string)$request->U_SYP_CCONCEPTO,
                        "U_SYP_DCONCEPTO"   => (string)$request->U_SYP_DCONCEPTO,
                        "U_SYP_CDOCUMENTO"  => (string)$request->U_SYP_CDOCUMENTO,
                        "U_SYP_DSDOCUMENTO"  => (string)$request->U_SYP_DDOCUMENTO,
                        "U_SYP_IMPORTE"     => (string)$U_SYP_IMPORTE,
                        "U_SYP_COSTO"       => (string)$request->U_SYP_COSTO,
                        "U_SYP_ESTADO"      => (string)$request->U_SYP_ESTADO
                    ]
                ]
            ]
        ];

        $response = $client->request('POST', "/api/TblCosto/SapPachTblCostoDet/", $json);
        return $response->getBody();
    }
}
