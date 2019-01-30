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
            array_push($array_rpta, $rptaSap);
        }
        return $array_rpta;
    }
}
