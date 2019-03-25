<?php

namespace App\Http\Controllers\api;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SapAsientoContableController extends Controller
{
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
                    "Memo"                  =>  "WO-".$value['cProjectCode'],
                    "ProjectCode"           =>  $value['cProjectCode'],
                    "Reference2"            =>  $value['cProjectCode'],
                    "JournalEntryLines"    => 
                        [
                            [
                                "AccountCode"       =>  "012110",
                                "ProjectCode"       =>  $value['cProjectCode'],
                                /*"Credit"          =>  (string)$value['fCredit'],
                                "Debit"             =>  (string)$value['fDebit']*/
                                "FCDebit"           => (string)$value['fCredit'],
                                "FCCredit"          => (string)$value['fDebit'],
                                "FCCurrency"        => "US$"
                            ],
                            [
                                "AccountCode"       =>  "099111",
                                "ProjectCode"       =>  $value['cProjectCode'],
                                /*"Credit"            =>  (string)$value['fCredit1'],
                                "Debit"             =>  (string)$value['fDebit1'],*/
                                "FCDebit"           => (string)$value['fCredit1'],
                                "FCCredit"          => (string)$value['fDebit1'],
                                "FCCurrency"        => "US$"
                            ]
                        ]
                ]
            ];

            $response = $client->request('POST', "/api/AsientoContable/SapSetAsientoContable/", $json);
            $rptaSap = json_decode($response->getBody());
            array_push($array_rpta, $rptaSap);
        }
        return $array_rpta;
    }
    public function SapSetAsientoContableWF(Request $request)
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
                    "Memo"                  =>  "WF-".$value['cProjectCode'],
                    "ProjectCode"           =>  $value['cProjectCode'],
                    "Reference2"            =>  $value['cProjectCode'],
                    "JournalEntryLines"    => 
                        [
                            [
                                "AccountCode"       =>  "012310",
                                "ProjectCode"       =>  $value['cProjectCode'],
                                "FCDebit"           => (string)$value['fCredit'],
                                "FCCredit"          => (string)$value['fDebit'],
                                "FCCurrency"        => "US$"
                            ],
                            [
                                "AccountCode"       =>  "061110",
                                "ProjectCode"       =>  $value['cProjectCode'],
                                "FCDebit"           => (string)$value['fCredit1'],
                                "FCCredit"          => (string)$value['fDebit1'],
                                "FCCurrency"        => "US$"
                            ]
                        ]
                ]
            ];

            $response = $client->request('POST', "/api/AsientoContable/SapSetAsientoContable/", $json);
            $rptaSap = json_decode($response->getBody());
            array_push($array_rpta, $rptaSap);
        }
        return $array_rpta;
    }
}
