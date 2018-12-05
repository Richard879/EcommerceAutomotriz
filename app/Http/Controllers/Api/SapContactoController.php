<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SapContactoController extends Controller
{
    /// ============================================================
    /// METODOS SERVICES LAYER
    /// ============================================================
    /// 
    public function SapSetContacto(Request $request)
    {
        $client = new Client([
            'base_uri'  => 'http://172.20.6.54/'
        ]);

        $json = [
            'json' => [
                "CardCode" => $request->CompanyDB,
                "CardType" => "cCustomer",
                "CardName" => $request->UserName,
                "FederalTaxID" => $request->Password,
                "U_SAI_CAMPO3" => $request->Password,
                "EmailAddress" => $request->Password
               ]
           ];

        $response = $client->request('POST', "/api/Contacto/SapSetContacto/", $json);
        return $response->getBody();
    }

    public function SapGetValidarContacto(Request $request)
    {
        $client = new Client([
            'base_uri'  => 'http://172.20.6.54/'
        ]);
        
        $User = Auth::user()->id;
        $CardCode = 'C'.$User;

        $json = [
            'json' => [
                "CardCode" => $CardCode
               ]
           ];

        $response = $client->request('POST', "/Sap/api/Contacto/SapGetValidarContacto/", $json);
        return $response->getBody();
    }
}
