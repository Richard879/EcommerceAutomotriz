<?php

namespace App\Http\Controllers\api;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SapAsientoContableController extends Controller
{
    // ""Memo"": ""Creado desde SL"",  //Comentario
    //""JournalEntryLines"": [
                                                /*{   
                                                    ""AccountCode"": ""2011101"", //CUENTA CONTABLE
                                                    ""ContraAccountCode"": ""6911001"",
                                                    ""Credit"": 200, 
                                                    ""Debit"" : 0 
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
            'base_uri'  => 'http://localhost:49454/'
        ]);

        $array_rpta = [];
        $rptaSap   = [];

        $data = $request->data;
        foreach ($data as $key => $value) {

            $json = [
                'json' => [
                    "Memo"                  =>  $value['ProjectCode'],
                    "ProjectCode"           =>  $value['ProjectCode'],
                    "JournalEntryLines"    => 
                        [
                            [
                                "AccountCode"           =>  "421111", //012110
                                "ProjectCode"           =>  $value['ProjectCode'],
                                "Credit"                =>  (string)$value['fCredit'],
                                "Debit"                 =>  (string)$value['fDebit']
                            ],
                            [
                                "AccountCode"           =>  "201113", //099111
                                "ProjectCode"           =>  $value['ProjectCode'],
                                "Credit"                =>  (string)$value['fCredit1'],
                                "Debit"                 =>  (string)$value['fDebit1']
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
