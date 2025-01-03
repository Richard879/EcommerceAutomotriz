<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SapLlamadaServicioController extends Controller
{
    public function SapSetLlamadaServicioCompra(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => config('integracion.webservice')
        ]);

        $array_rpta = [];
        $rptaSap   = [];

        $data = $request->data;
        foreach ($data as $key => $value) {

            $json = [
                'json' => [
                    "nIdEmpresa"           => (string)$request->nIdEmpresa,
                    "CustomerCode"         => $value['cCustomerCode'],
                    "InternalSerialNum"    => $value['cInternalSerialNum'],
                    "ItemCode"             => $value['cItemCode'],
                    "Subject"              => $value['cSubject'],
                    "ServiceCallActivities" => [
                        [
                            "ActivityCode"=> (string)$value['nActivityCode']
                        ]
                    ],
                    "ServiceCallSolutions" => [
                        [
                            "SolutionID"=> (string)$value['nSolutionCode']
                        ]
                    ]
                ]
            ];

            $response = $client->request('POST', config('integracion.ruta') . "LlamadaServicio/SapSetLlamadaServicio/", $json);
            $rptaSap = json_decode($response->getBody());
            array_push($array_rpta, $rptaSap);
        }
        return $array_rpta;
    }

    public function SapSetLlamadaServicioVenta(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => config('integracion.webservice')
        ]);

        // ======================================================================
        // GENERAR LLAMADA DE SERVICIO PARA EL VEHÍCULO
        // ======================================================================
        //Setear arreglos para Pedido (Vehiculo)
        $arrayVehiculo  = [];
        $rptaSap   = [];

        $json = [
            'json' => [
                "nIdEmpresa"            =>  (string)$request->nIdEmpresa,
                "CustomerCode"          =>  $request->cCustomerCode,
                "InternalSerialNum"     =>  $request->cInternalSerialNum,
                "ItemCode"              =>  $request->cItemCode,
                "Subject"               =>  $request->cSubject,
                "ServiceCallActivities" =>  array(),
                "ServiceCallSolutions" => [
                    [
                        "SolutionID"=> (string)$request->nSolutionCode
                    ]
                ]
            ]
        ];

        //Inicializo el contador de la lina (Actividad)
        $cont = 0;

        $arraySapLlamadaServicioLength = sizeof($request->arraySapLlamadaServicio);
        if($arraySapLlamadaServicioLength > 0) {
            $data = $request->arraySapLlamadaServicio;
            foreach ($data as $key => $value) {
                $json['json']['ServiceCallActivities'][] = [
                    "ActivityCode"  =>  (string)$value['nActivityCode'],
                ];
                $cont++;//Aumento Linea
            }
        }

        $response = $client->request('POST', config('integracion.ruta') . "LlamadaServicio/SapSetLlamadaServicio/", $json);
        $rptaSap = json_decode($response->getBody());
        array_push($arrayVehiculo, $rptaSap);

        return [
            'arrayVehiculo' =>  $arrayVehiculo
        ];
    }

    public function SapSetLlamadaServicio(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => config('integracion.webservice')
        ]);

        $array_rpta = [];
        $rptaSap   = [];

        $data = $request->data;
        foreach ($data as $key => $value) {

            $json = [
                'json' => [
                    "nIdEmpresa"           => (string)$request->nIdEmpresa,
                    "CustomerCode"         => $value['cCustomerCode'],
                    "InternalSerialNum"    => $value['cInternalSerialNum'],
                    "ItemCode"             => $value['cItemCode'],
                    "Subject"              => $value['cSubject'],
                    "ServiceCallActivities" => [
                        [
                            "ActivityCode"=> (string)$value['nActivityCode']
                        ]
                    ],
                    "ServiceCallSolutions" => [
                        [
                            "SolutionID"=> (string)$value['nSolutionCode']
                        ]
                    ]
                ]
            ];

            $response = $client->request('POST', config('integracion.ruta') . "LlamadaServicio/SapSetLlamadaServicio/", $json);
            $rptaSap = json_decode($response->getBody());
            array_push($array_rpta, $rptaSap);
        }
        return $array_rpta;
    }

    public function SapCloseLlamadaServicio(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => config('integracion.webservice')
        ]);

        $array_rpta = [];
        $rptaSap   = [];

        $data = $request->data;
        foreach ($data as $key => $value) {

            $json = [
                'json' => [
                    "nIdEmpresa"        => (string)$request->nIdEmpresa,
                    "ServiceCallID"     => $value['nServiceCallID'],
                    "Status"            => $value['nStatusClose']
                ]
            ];

            $response = $client->request('POST', config('integracion.ruta') . "LlamadaServicio/SapPatchLlamadaServicio/", $json);
            $rptaSap = json_decode($response->getBody());
            array_push($array_rpta, $rptaSap);
        }
        return $array_rpta;
    }

    public function SapSetSolucion(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => config('integracion.webservice')
        ]);

        $array_rpta = [];
        $rptaSap   = [];

        $data = $request->data;
        foreach ($data as $key => $value) {

            $json = [
                'json' => [
                    "nIdEmpresa"    => (string)$request->nIdEmpresa,
                    "ItemCode"      => $value['cItemCode'],
                    "Solution"      => $value['cSubject']
                ]
            ];

            $response = $client->request('POST', config('integracion.ruta') . "LlamadaServicio/SapSetSolucion/", $json);
            $rptaSap = json_decode($response->getBody());
            array_push($array_rpta, $rptaSap);
        }
        return $array_rpta;
    }
}
