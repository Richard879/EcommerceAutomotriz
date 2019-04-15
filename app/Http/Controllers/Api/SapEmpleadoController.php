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
        // return $request;

        $client = new Client([
            'verify'    => false,
            // 'base_uri'  => 'http://localhost:49454/'
            'base_uri'  => 'http://172.20.0.10/'
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

        $response = $client->request('POST', "/api/Empleado/SapSetEmpleado/", $json);
        return $response->getBody();
    }

    public function SapPatchEmpleado(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => 'http://172.20.0.10/'
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

        $response = $client->request('POST', "/api/Empleado/SapPatchEmpleado/", $json);
        return $response->getBody();
    }
}
