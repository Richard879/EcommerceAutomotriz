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

        $array_rpta = [];
        $rptaSap   = [];

        $data = $request->data;
        foreach ($data as $key => $value) {

            $json = [
                'json' => [
                    "CustomerCode"         => $value['cCustomerCode'],
                    "InternalSerialNum"    => $value['cInternalSerialNum'],
                    "ItemCode"             => $value['cItemCode'],
                    "Subject"              => $value['cSubject'],
                    "ServiceCallActivities" => [
                        [
                            "ActivityCode"=> (string)$value['nActivityCode']
                        ]
                    ]
                ]
            ];

            $response = $client->request('POST', "/api/LlamadaServicio/SapSetLlamadaServicio/", $json);
            $rptaSap = json_decode($response->getBody());
            array_push($array_rpta, $rptaSap);
        }
        return $array_rpta;
    }

    public function SapSetLlamadaServicioVenta(Request $request)
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

        $json = [
            'json' => [
                "CustomerCode"          =>  $request->cCustomerCode,
                "InternalSerialNum"     =>  $request->cInternalSerialNum,
                "ItemCode"              =>  $request->cItemCode,
                "Subject"               =>  $request->cSubject,
                "ServiceCallActivities" =>  array()
            ]
        ];

        //Inicializo el contador de la lina (Actividad)
        $cont = 0;

        $arraySapLlamadaServicioLength = sizeof($request->arraySapLlamadaServicio);
        if($arraySapLlamadaServicioLength > 0) {
            $data = $request->arraySapLlamadaServicio;
            foreach ($data as $key => $value) {
                $json['json']['ServiceCallActivities'][] = [
                    "LineNum"       =>  $cont,
                    "ActivityCode"  =>  (string)$value['nActivityCode'],
                ];
                $cont++;//Aumento Linea
            }
        }

        $response = $client->request('POST', "/api/LlamadaServicio/SapSetLlamadaServicio/", $json);
        $rptaSap = json_decode($response->getBody());
        array_push($arrayVehiculo, $rptaSap);

        // ======================================================================
        // GENERAR LLAMADA DE SERVICIO PARA LOS/EL ELEMENTO VENTA
        // ======================================================================
        //Setear arreglos para Pedido (Elemento Venta)
        /*
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
        */

        return [
            'arrayVehiculo' =>  $arrayVehiculo
            // 'arrayEV'       =>  $arrayEV
        ];
    }

}
