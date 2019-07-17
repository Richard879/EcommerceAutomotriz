<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class SapTipoCambioController extends Controller
{
    private $cnxIntegration = 'http://172.20.0.10:8020/';

    public function SapGetTipoCambioByFecha(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => $this->cnxIntegration
        ]);
        
        $nIdEmpresa = $request->nIdEmpresa;
        $dFecha     = $request->dfecha;

        $response = $client->request('GET', "/pruebas/TipoCambio/GetTipoCambio/", [
                                                                                'query' => ['nIdEmpresa'=> $nIdEmpresa,
                                                                                            'fecha'     => $dFecha]
                                                                            ]);
        return $response->getBody();
    }
}
