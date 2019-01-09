<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SapContactoController extends Controller
{
    ////=================== SERVER PUBLISH =====================
    //'base_uri' => 'http://172.20.0.10/'
    //$response = $client->request('GET', "/api/Contacto/SapGetValidarContacto", $json);
    ////=================== LOCAL SERVER =====================
    //'base_uri' => 'http://172.20.6.55/'
    //$response = $client->request('GET', "/Sap/api/Contacto/SapGetValidarContacto/", $json);
    ////=================== LOCAL DEBUG =====================
    //'base_uri' => 'http://localhost:49454/'
    //$response = $client->request('GET', "/api/Contacto/SapGetValidarContacto/", $json);

    /// ============================================================
    /// METODOS SERVICES LAYER
    /// ============================================================
    ///
    public function SapGetValidarContacto(Request $request)
    {
        $client = new Client([
            'base_uri'  => 'http://172.20.0.10/'
        ]);

        // $User       = Auth::user()->id;
        // $CardCode   = 'C'.$User;
        $CardCode   =   "C". $request->nIdContacto;

        $json = [
                    'json' => [
                        "CardCode" => $CardCode
                    ]
                ];

        $response = $client->request('POST', "/api/Contacto/SapGetValidarContacto/", $json);
        return $response->getBody();
    }

    public function SapSetContacto(Request $request)
    {
        $client = new Client([
            'base_uri'  => 'http://172.20.0.10/'
        ]);

        // return $request;

        $CardCode       =   "C". $request->contacto['nIdContacto'];
        $UserName       =   $request->contacto['cContacto'];
        $FederalTaxID   =   $request->contacto['cNumeroDocumento'];
        $U_SAI_CAMPO3   =   1;
        $EmailAddress   =   $request->contacto['cEmail'];
        $Address        =   $request->contacto['cDireccion'];
        $Cellular       =   $request->contacto['nTelefonoMovil'];
        $City           =   $request->contacto['cUbigeo'];

        $json = [
            'json' => [
                "CardCode"      => $CardCode,
                "CardType"      => "cCustomer",
                "CardName"      => $UserName,
                "FederalTaxID"  => $FederalTaxID,
                "U_SAI_CAMPO3"  => $U_SAI_CAMPO3,
                "EmailAddress"  => $EmailAddress,
                "Address"       => $Address,
                "Cellular"      => $Cellular,
                "City"          => $City
               ]
           ];

        $response = $client->request('POST', "/api/Contacto/SapSetContacto/", $json);
        return $response->getBody();
    }

    public function SapSetContacto2(Request $request)
    {
        $client = new Client([
            'base_uri'  => 'http://172.20.0.10/'
        ]);

        $CardCode       =   "C". $request->nIdContacto;
        $UserName       =   $request->CardName;
        $FederalTaxID   =   $request->FederalTaxID;
        $U_SAI_CAMPO3   =   1;
        $EmailAddress   =   $request->EmailAddress;
        $Address        =   $request->Address;
        $Cellular       =   $request->Cellular;
        $City           =   $request->City;

        $json = [
            'json' => [
                "CardCode"      => $CardCode,
                "CardType"      => "cCustomer",
                "CardName"      => $UserName,
                "FederalTaxID"  => $FederalTaxID,
                "U_SAI_CAMPO3"  => $U_SAI_CAMPO3,
                "EmailAddress"  => $EmailAddress,
                "Address"       => $Address,
                "Cellular"      => $Cellular,
                "City"          => $City
               ]
           ];

        $response = $client->request('POST', "/api/Contacto/SapSetContacto/", $json);
        return $response->getBody();
    }
}
