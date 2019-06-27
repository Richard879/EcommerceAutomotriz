<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SapEmpleadoController extends Controller
{
    private $cnxIntegration = 'http://172.20.0.10:8020/';

    public function SapSetEmpleado(Request $request)
    {
        // return $request;

        $client = new Client([
            'verify'    => false,
            'base_uri'  => $this->cnxIntegration
        ]);

        $cNombre    =   $request->cNombre;
        $cRol       =   $request->cRol;

        $json = [
            'json' => [
                "SalesEmployeeName" =>  (string)$cNombre,
                "Remarks"           =>  (string)$cRol,
                "Active"            =>  "tYES"
            ]
        ];

        $response = $client->request('POST', "/pruebas/Empleado/SapSetEmpleado/", $json);
        return $response->getBody();
    }

    public function SapPatchEmpleado(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => $this->cnxIntegration
        ]);

        $cNombre    =   $request->cNombre;
        $cRol       =   $request->cRol;

        $json = [
            'json' => [
                "SalesEmployeeName" =>  (string)$cNombre,
                "Remarks"           =>  (string)$cRol,
                "Active"            =>  "tYES"
            ]
        ];

        $response = $client->request('POST', "/pruebas/Empleado/SapPatchEmpleado/", $json);
        return $response->getBody();
    }
}
