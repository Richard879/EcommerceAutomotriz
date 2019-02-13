<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SapLlamadaServicioController extends Controller
{
    public function SapSetLlamadaServicio(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => 'http://172.20.0.10/'
        ]);

        // ======================================================================
        // GENERAR LLAMADA DE SERVICIO PARA EL VEHÍCULO
        // ======================================================================
        //Setear arreglos para Pedido (Vehiculo)
        $arrayVehiculo  = [];
        $rptaSap   = [];

        $arraySapLlamadaServicioVehiculoLength = sizeof($request->arraySapLlamadaServicioVehiculo);
        if($arraySapLlamadaServicioVehiculoLength > 0) {
            //Guardar Arreglo de Vehículo
            $arraySapLlamadaServicioVehiculo = $request->arraySapLlamadaServicioVehiculo;

            foreach ($arraySapLlamadaServicioVehiculo as $key => $value) {
                $json = [
                    'json' => [
                        "CustomerCode"          => $value['cCustomerCode'],
                        "InternalSerialNum"     => $value['cInternalSerialNum'],
                        "ItemCode"              => $value['cItemCode'],
                        "Subject"               => $value['cSubject'],
                        "ServiceCallActivities" => [
                            [
                                "LineNum"       => 0,
                                "ActivityCode"  => (string)$value['nActivityCode']
                            ]
                        ]
                    ]
                ];

                $response = $client->request('POST', "/api/LlamadaServicio/SapSetLlamadaServicio/", $json);
                $rptaSap = json_decode($response->getBody());
                array_push($arrayVehiculo, $rptaSap);
            }
        }

        // ======================================================================
        // GENERAR LLAMADA DE SERVICIO PARA LOS/EL ELEMENTO VENTA
        // ======================================================================
        //Setear arreglos para Pedido (Elemento Venta)
        $arrayEV    = [];
        $rptaSap    = [];

        $arraySapLlamadaServicioEVLength = sizeof($request->arraySapLlamadaServicioEV);
        if($arraySapLlamadaServicioEVLength > 0) {
            //Guardar Arreglo de Ele. Venta
            $arraySapLlamadaServicioEV = $request->arraySapLlamadaServicioEV;

            foreach ($arraySapLlamadaServicioEV as $key => $value) {
                $json = [
                    'json' => [
                        "CustomerCode"          => $value['cCustomerCode'],
                        "InternalSerialNum"     => $value['cInternalSerialNum'],
                        "ItemCode"              => $value['cItemCode'],
                        "Subject"               => $value['cSubject'],
                        "ServiceCallActivities" => [
                            [
                                "LineNum"       => 0,
                                "ActivityCode"  => (string)$value['nActivityCode']
                            ]
                        ]
                    ]
                ];

                $response = $client->request('POST', "/api/LlamadaServicio/SapSetLlamadaServicio/", $json);
                $rptaSap = json_decode($response->getBody());
                array_push($arrayEV, $rptaSap);
            }
        }

        return [
            'arrayVehiculo' =>  $arrayVehiculo,
            'arrayEV'       =>  $arrayEV
        ];
    }
}
