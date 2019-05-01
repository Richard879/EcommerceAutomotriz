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
            'base_uri'  => 'http://172.20.0.10:8020/'
        ]);
        
        $dFecha     = $request->dfecha;

        $response = $client->request('GET', "/pruebas/TipoCambio/GetTipoCambio/", [
                                                                                'query' => ['fecha' => $dFecha]
                                                                            ]);
        return $response->getBody();
    }
}
