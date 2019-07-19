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
    public function SapSetEmpleado(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => config('integracion.webservice')
        ]);

        $cNombre    =   $request->cNombre;
        $cRol       =   $request->cRol;

        $json = [
            'json' => [
                "nIdEmpresa"        => (string)$request->nIdEmpresa,
                "SalesEmployeeName" =>  (string)$cNombre,
                "Remarks"           =>  (string)$cRol,
                "Active"            =>  "tYES"
            ]
        ];

        $response = $client->request('POST', config('integracion.ruta') . "Empleado/SapSetEmpleado/", $json);
        return $response->getBody();
    }

    public function SapPatchEmpleado(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => config('integracion.webservice')
        ]);

        $cNombre    =   $request->cNombre;
        $cRol       =   $request->cRol;

        $json = [
            'json' => [
                "nIdEmpresa"        => (string)$request->nIdEmpresa,
                "SalesEmployeeName" =>  (string)$cNombre,
                "Remarks"           =>  (string)$cRol,
                "Active"            =>  "tYES"
            ]
        ];

        $response = $client->request('POST', config('integracion.ruta') . "Empleado/SapPatchEmpleado/", $json);
        return $response->getBody();
    }
}
