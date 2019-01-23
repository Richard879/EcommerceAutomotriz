<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SapMercanciaController extends Controller
{
    public function SapSetMercanciaByOC(Request $request)
    {
        $client = new Client([
            'base_uri'  => 'http://localhost:49454/'
        ]);

        $array_rpta = [];
        $rptaSap   = [];

        $User       =   Auth::user()->id;
        $cCardCode  =   'C'.$User;

        $data = $request->data;
        foreach ($data as $key => $value) {
            $json = [
                'json' => [
                    "CardCode"      => $request->cCardCode,
                    //"DocDate"       => (string)$request->fDocDate,
                    //"DocDueDate"    => (string)$request->fDocDueDate,
                    "U_SYP_MDMT"    =>  "01",
                    "U_SYP_MDTD"    =>  "01",
                    "U_SYP_MDSD"    =>  "1235",
                    "U_SYP_MDCD"    =>  "12345679",
                    "U_SYP_TCOMPRA" =>  "01",
                    "DocumentLines" => [
                            [
                                "BaseType"      =>  "22",
                                "BaseEntry"     =>  (string)$value['nDocEntry']
                            ]
                        ]
                    ]
                ];

            $response = $client->request('POST', "/api/Mercancia/SapSetMercanciaByOC/", $json);
            $rptaSap = json_decode($response->getBody());
            array_push($array_rpta, $rptaSap);
        }
        return $array_rpta;
    }
}
