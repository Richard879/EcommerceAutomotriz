<?php

namespace App\Http\Controllers\api;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SapAsientoContableController extends Controller
{
    //
                                                /*{   
                                                    ""AccountCode"": ""2011101"", //CUENTA CONTABLE
                                                    ""ContraAccountCode"": ""6911001"",
                                                    ""Credit"": 200, Haber
                                                    ""Debit"" : 0 Debe
                                                },
                                                {
                                                    ""AccountCode"": ""2011102"",
                                                    ""ContraAccountCode"": ""6911001"",
                                                    ""Credit"": 0,
                                                    ""Debit"" : 20
                                                },
                                                {
                                                    ""AccountCode"": ""6911001"",
                                                    ""Credit"": 0,
                                                    ""Debit"" : 120
                                                }*/

    public function SapSetAsientoContableWO(Request $request)
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
                    "AccountCode"           =>  "012110",
                    "ContraAccountCode"     =>  "099111",
                    "ProjectCode"           =>  $value['ProjectCode'],
                    "Debit"                 =>  $value['fDebit'],  //Debe
                    "Credit"                =>  $value['fCredit']  //Haber
                ]
            ];

            $response = $client->request('POST', "/api/AsientoContable/SapSetAsientoContable/", $json);
            $rptaSap = json_decode($response->getBody());
            array_push($array_rpta, $rptaSap);
        }
        return $array_rpta;
    }
}
