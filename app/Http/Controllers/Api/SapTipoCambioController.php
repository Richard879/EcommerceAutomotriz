<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class SapTipoCambioController extends Controller
{
    public function SapGetTipoCambioByFecha(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => config('integracion.webservice')
        ]);

        $nIdEmpresa = $request->nIdEmpresa;
        $dFecha     = $request->dfecha;

        $response = $client->request('GET', config('integracion.ruta') . "TipoCambio/GetTipoCambio/", [
                                                                                'query' => [
                                                                                    'nIdEmpresa'=> $nIdEmpresa,
                                                                                    'fecha'     => $dFecha
                                                                                ]
                                                                            ]);
        return $response->getBody();
    }
}
