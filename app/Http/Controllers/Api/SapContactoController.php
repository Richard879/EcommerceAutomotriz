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
        return $request;

        $client = new Client([
            'base_uri'  => 'http://172.20.0.10/'
        ]);

        $tipoPersona = $request->contacto['cFlagTipoPersona'];

        $CardCode       =   "C". $request->contacto['cNumeroDocumento'];
        $UserName       =   $request->contacto['cContacto'];
        $FederalTaxID   =   $request->contacto['cNumeroDocumento'];
        $EmailAddress   =   $request->contacto['cEmail'];
        $Address        =   $request->contacto['cDireccion'];
        $Cellular       =   $request->contacto['nTelefonoMovil'];
        $City           =   $request->contacto['cUbigeo'];

        if ($tipoPersona == 'N') {
            $U_SYP_BPAP =   $request->contacto['cApellidoPaterno'];
            $U_SYP_BPAM =   $request->contacto['cApellidoMaterno'];
            $U_SYP_BPNO =   $request->contacto['cNombre'];
            //explode — Divide un string en varios string separados por un criterio
            $arrayNombres = explode(" ", $U_SYP_BPNO);
            //Determina si existe mas de un nombre
            $arrayNombresLength = sizeof($arrayNombres);
            if($arrayNombresLength > 1) {
                $U_SYP_BPN2 =   $arrayNombres[1];
            } else {
                $U_SYP_BPN2 =   " ";
            }
            $U_SYP_BPTP =   "TPN";
            $U_SYP_BPTD =   "1";

            $json = [
                'json' => [
                    "CardCode"      =>  $CardCode,
                    "CardType"      =>  "cCustomer",
                    "CardName"      =>  $UserName,
                    "FederalTaxID"  =>  $FederalTaxID,
                    "EmailAddress"  =>  $EmailAddress,
                    "Cellular"      =>  $Cellular,
                    // "City"          =>  $City,
                    "Currency"      =>  "##",
                    "U_SYP_BPAP"    =>  $U_SYP_BPAP,
                    "U_SYP_BPAM"    =>  $U_SYP_BPAM,
                    "U_SYP_BPNO"    =>  $U_SYP_BPNO,
                    "U_SYP_BPN2"    =>  $U_SYP_BPN2,
                    "U_SYP_BPTP"    =>  $U_SYP_BPTP,
                    "U_SYP_BPTD"    =>  $U_SYP_BPTD,
                    "BPAddresses" => [
                        [
                            "AddressName"   =>  "Domicilio Fiscal",
                            "Street"        =>  $Address,
                            "Country"       =>  "PE",
                            "AddressType"   =>  "bo_BillTo",
                            "BPCode"        =>  $CardCode,
                        ],
                        [
                            "AddressName"   =>  "Domicilio Despacho",
                            "Street"        =>  $Address,
                            "Country"       =>  "PE",
                            "AddressType"   =>  "bo_ShipTo",
                            "BPCode"        =>  $CardCode
                        ]
                    ]
                ]
            ];
        } else {
            $U_SYP_BPTP = "TPJ";
            $U_SYP_BPTD = "6";

            $json = [
                'json' => [
                    "CardCode"      =>  $CardCode,
                    "CardType"      =>  "cCustomer",
                    "CardName"      =>  $UserName,
                    "FederalTaxID"  =>  $FederalTaxID,
                    "EmailAddress"  =>  $EmailAddress,
                    // "Address"       =>  $Address,
                    "Cellular"      =>  $Cellular,
                    // "City"          =>  $City,
                    "Currency"      =>  "##",
                    "U_SYP_BPTP"    =>  $U_SYP_BPTP,
                    "U_SYP_BPTD"    =>  $U_SYP_BPTD,
                    "BPAddresses" => [
                        [
                            "AddressName"   =>  "Domicilio Fiscal",
                            "Street"        =>  $Address,
                            "Country"       =>  "PE",
                            "AddressType"   =>  "bo_BillTo",
                            "BPCode"        =>  $CardCode,
                        ],
                        [
                            "AddressName"   =>  "Domicilio Despacho",
                            "Street"        =>  $Address,
                            "Country"       =>  "PE",
                            "AddressType"   =>  "bo_ShipTo",
                            "BPCode"        =>  $CardCode
                        ]
                    ]
                ]
            ];
        }

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
                "EmailAddress"  => $EmailAddress,
                "Address"       => $Address,
                "Cellular"      => $Cellular,
                "City"          => $City,
                "Currency"      =>	"##"
               ]
           ];

        $response = $client->request('POST', "/api/Contacto/SapSetContacto/", $json);
        return $response->getBody();
    }
}
