<?php

namespace App\Http\Controllers\api;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        //=====================================================================
        //================== Obtener Cuentas contables ========================
        $data1 = DB::select('exec [usp_TipoPar_GetTipoByIdParametro] ?, ?, ?',
                                                            [   1300526,
                                                                'D',
                                                                65
                                                            ]);
        //Obtener AccountCode
        $cAccountCode1   =   $data1[0]->cDatoParDescripcion;

        //Obtener Cuenta Puente Asiento Contable
        $data2 = DB::select('exec [usp_TipoPar_GetTipoByIdParametro] ?, ?, ?',
                                                            [   1300526,
                                                                '',
                                                                66
                                                            ]);
        $cAccountCode2   =   $data2[0]->cDatoParDescripcion;
        //=================================================================

        $data = $request->data;
        foreach ($data as $key => $value) {

            $json = [
                'json' => [
                    "Memo"                  =>  "WO-".$value['cProjectCode'],
                    "ProjectCode"           =>  $value['cProjectCode'],
                    "Reference2"            =>  $value['cProjectCode'],
                    "JournalEntryLines"     =>
                    [
                        [
                            "AccountCode"       =>  (string)$cAccountCode1, // //012110
                            "ProjectCode"       =>  $value['cProjectCode'],
                            /*"Credit"          =>  (string)$value['fCredit'],
                            "Debit"             =>  (string)$value['fDebit']*/
                            "FCDebit"           =>  (string)$value['fCredit'],
                            "FCCredit"          =>  (string)$value['fDebit'],
                            "FCCurrency"        =>  "US$"
                        ],
                        [
                            "AccountCode"       =>  (string)$cAccountCode2,  // //099111
                            "ProjectCode"       =>  $value['cProjectCode'],
                            /*"Credit"            =>  (string)$value['fCredit1'],
                            "Debit"             =>  (string)$value['fDebit1'],*/
                            "FCDebit"           =>  (string)$value['fCredit1'],
                            "FCCredit"          =>  (string)$value['fDebit1'],
                            "FCCurrency"        =>  "US$"
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

        //=====================================================================
        //================== Obtener Cuentas contables ========================
        $data1 = DB::select('exec [usp_TipoPar_GetTipoByIdParametro] ?, ?, ?',
                                                            [   1300527,
                                                                'D',
                                                                67
                                                            ]);
        //Obtener AccountCode
        $cAccountCode1   =   $data1[0]->cDatoParDescripcion;

        $data2 = DB::select('exec [usp_TipoPar_GetTipoByIdParametro] ?, ?, ?',
                                                            [   1300527,
                                                                'D',
                                                                68
                                                            ]);
        //Obtener AccountCode
        $cAccountCode2   =   $data2[0]->cDatoParDescripcion;
        //=================================================================

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
                                "AccountCode"       =>  (string)$cAccountCode1,
                                "ProjectCode"       =>  $value['cProjectCode'],
                                "FCDebit"           => (string)$value['fCredit'],
                                "FCCredit"          => (string)$value['fDebit'],
                                "FCCurrency"        => "US$"
                            ],
                            [
                                "AccountCode"       =>  (string)$cAccountCode2,
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
