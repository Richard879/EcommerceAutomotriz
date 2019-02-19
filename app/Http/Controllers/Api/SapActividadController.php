<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SapActividadController extends Controller
{
    public function SapSetActividad(Request $request)
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
                    "ActivityDate"      => (string)$value['dActivityDate'],
                    "ActivityTime"      => $value['hActivityTime'],
                    "CardCode"          => $value['cCardCode'],
                    "Notes"             => $value['cNotes'],
                    "DocEntry"          => $value['nDocEntry'],
                    "DocNum"            => $value['nDocNum'],
                    "DocType"           => $value['nDocType'],
                    "ActivityProperty"  => "cn_Task",
                    "Duration"          => $value['nDuration'],
                    "DurationType"      => $value['cDurationType'],
                    "EndDueDate"        => (string)$value['dEndDueDate'],
                    "EndTime"           => $value['hEndTime'],
                    "Reminder"          => $value['cReminder'],
                    "ReminderPeriod"    => $value['nReminderPeriod'],
                    "ReminderType"      => $value['cReminderType'],
                    "StartDate"         => (string)$value['dStartDate'],
                    "StartTime"         => $value['hStartTime']
                ]
            ];

            $response = $client->request('POST', "/api/Actividad/SapSetActividad/", $json);
            $rptaSap = json_decode($response->getBody());
            array_push($array_rpta, $rptaSap);
        }
        return $array_rpta;
    }

    public function SapSetActividadVenta(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => 'http://172.20.0.10/'
        ]);

        // ======================================================================
        // GENERAR ACTIVIDAD PARA EL VEHICULO
        // ======================================================================
        //Setear arreglos para Pedido (Vehiculo)
        $arrayVehiculo  = [];
        $rptaSap   = [];

        $arraySapActividadVehiculoLength = sizeof($request->arraySapActividadVehiculo);
        if($arraySapActividadVehiculoLength > 0) {
            //Guardar Arreglo de Vehículo
            $arraySapActividadVehiculo = $request->arraySapActividadVehiculo;
            foreach ($arraySapActividadVehiculo as $key => $value) {
                $json = [
                    'json' => [
                        "ActivityDate"      => (string)$value['dActivityDate'],
                        "ActivityTime"      => $value['hActivityTime'],
                        "CardCode"          => $value['cCardCode'],
                        "Notes"             => $value['cNotes'],
                        "DocEntry"          => $value['nDocEntry'],
                        "DocNum"            => $value['nDocNum'],
                        "DocType"           => $value['nDocType'],
                        "Duration"          => $value['nDuration'],
                        "DurationType"      => $value['cDurationType'],
                        "EndDueDate"        => (string)$value['dEndDueDate'],
                        "EndTime"           => $value['hEndTime'],
                        "Reminder"          => $value['cReminder'],
                        "ReminderPeriod"    => $value['nReminderPeriod'],
                        "ReminderType"      => $value['cReminderType'],
                        "StartDate"         => (string)$value['dStartDate'],
                        "StartTime"         => $value['hStartTime']
                    ]
                ];

                $response = $client->request('POST', "/api/Actividad/SapSetActividad/", $json);
                $rptaSap = json_decode($response->getBody());
                array_push($arrayVehiculo, $rptaSap);
            }
        }

        // ======================================================================
        // GENERAR ACTIVIDAD PARA LOS ELEMENTOS DE VENTA
        // ======================================================================
        //Setear arreglos para Pedido (Elemento Venta)
        $arrayEV  = [];
        $rptaSap  = [];

        $arraySapActividadEVLength = sizeof($request->arraySapActividadEV);
        if($arraySapActividadEVLength > 0) {
            //Guardar Arreglo de Ele. Venta
            $arraySapActividadEV = $request->arraySapActividadEV;
            foreach ($arraySapActividadEV as $key => $value) {
                $json = [
                    'json' => [
                        "ActivityDate"      => (string)$value['dActivityDate'],
                        "ActivityTime"      => $value['hActivityTime'],
                        "CardCode"          => $value['cCardCode'],
                        "Notes"             => $value['cNotes'],
                        "DocEntry"          => $value['nDocEntry'],
                        "DocNum"            => $value['nDocNum'],
                        "DocType"           => $value['nDocType'],
                        "Duration"          => $value['nDuration'],
                        "DurationType"      => $value['cDurationType'],
                        "EndDueDate"        => (string)$value['dEndDueDate'],
                        "EndTime"           => $value['hEndTime'],
                        "Reminder"          => $value['cReminder'],
                        "ReminderPeriod"    => $value['nReminderPeriod'],
                        "ReminderType"      => $value['cReminderType'],
                        "StartDate"         => (string)$value['dStartDate'],
                        "StartTime"         => $value['hStartTime']
                    ]
                ];

                $response = $client->request('POST', "/api/Actividad/SapSetActividad/", $json);
                $rptaSap = json_decode($response->getBody());
                array_push($arrayEV, $rptaSap);
            }
        }

        return [
            'arrayVehiculo' =>  $arrayVehiculo,
            'arrayEV'       =>  $arrayEV
        ];
    }

    public function SapSetActividadEntregaVeh(Request $request)
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
                    "ActivityDate"      => (string)$value['dActivityDate'],
                    "ActivityTime"      => $value['hActivityTime'],
                    "CardCode"          => $value['cCardCode'],
                    "Notes"             => $value['cNotes'],
                    "ActivityProperty"  => "cn_Task",
                    "Duration"          => $value['nDuration'],
                    "DurationType"      => $value['cDurationType'],
                    "EndDueDate"        => (string)$value['dEndDueDate'],
                    "EndTime"           => $value['hEndTime'],
                    "Reminder"          => $value['cReminder'],
                    "ReminderPeriod"    => $value['nReminderPeriod'],
                    "ReminderType"      => $value['cReminderType'],
                    "StartDate"         => (string)$value['dStartDate'],
                    "StartTime"         => (string)$value['hStartTime']
                ]
            ];

            $response = $client->request('POST', "/api/Actividad/SapSetActividad/", $json);
            $rptaSap = json_decode($response->getBody());
            array_push($array_rpta, $rptaSap);
        }
        return $array_rpta;
    }
}
