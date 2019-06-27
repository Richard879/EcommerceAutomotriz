<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SapUbigeoController extends Controller
{
    private $cnxIntegration = 'http://172.20.0.10:8020/';

    public function SapGetUbigeo(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => $this->cnxIntegration
        ]);

        $nOpcion     = $request->nopcion;
        $cFiltro     = $request->cfiltro;
        $nOpcion = ($nOpcion == NULL) ? ($nOpcion = 0) : $nOpcion;
        $cFiltro = ($cFiltro == NULL) ? ($cFiltro = '0') : $cFiltro;

        $response = $client->request('GET', "/pruebas/Ubigeo/GetUbigeo/", [
                                                                        'query' => ['nOpcion' => $nOpcion,
                                                                                    'cFiltro' => $cFiltro]
                                                                      ]);
        return $response->getBody();
    }

}
