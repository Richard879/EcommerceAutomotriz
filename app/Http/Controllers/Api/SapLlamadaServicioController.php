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
                                "LineNum" => 0,
                                "ActivityCode"=> (string)$value['nActivityCode']
                        ]
                    ]
                ];

            $response = $client->request('POST', "/api/LlamadaServicio/SapSetLlamadaServicio/", $json);
            $rptaSap = json_decode($response->getBody());
            array_push($array_rpta, $rptaSap);
        }
        return $array_rpta;
    }
}
