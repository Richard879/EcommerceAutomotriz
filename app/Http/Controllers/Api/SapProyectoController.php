<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SapProyectoController extends Controller
{
    public function SapSetProyecto(Request $request)
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
                    "Code"          => $value['cCode'],
                    "Name"          => $value['cName']
                ]
            ];

            $response = $client->request('POST', config('integracion.ruta') . "Proyecto/SapSetProyecto/", $json);
            $rptaSap = json_decode($response->getBody());
            array_push($array_rpta, $rptaSap);
        }
        return $array_rpta;
    }
}
