<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SapContactoController extends Controller
{
    ////=================== SERVER PUBLISH =====================
    //'base_uri' => 'http://172.20.0.10:8020/'
    //$response = $client->request('GET', "/pruebas/Contacto/SapGetValidarContacto", $json);
    ////=================== LOCAL SERVER =====================
    //'base_uri' => 'http://172.20.6.55/'
    //$response = $client->request('GET', "/Sap/pruebas/Contacto/SapGetValidarContacto/", $json);
    ////=================== LOCAL DEBUG =====================
    //'base_uri' => 'http://localhost:49454/'
    //$response = $client->request('GET', "/pruebas/Contacto/SapGetValidarContacto/", $json);

    /// ============================================================
    /// METODOS SERVICES LAYER
    /// ============================================================
    ///
    public function SapGetValidarContacto(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => 'http://172.20.0.10:8020/'
        ]);

        // $User       = Auth::user()->id;
        // $CardCode   = 'C'.$User;
        $CardCode   =   "C". $request->nIdContacto;

        $json = [
                    'json' => [
                        "CardCode" => $CardCode
                    ]
                ];

        $response = $client->request('POST', "/pruebas/Contacto/SapGetValidarContacto/", $json);
        return $response->getBody();
    }

    public function SapSetContacto(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => 'http://172.20.0.10:8020/'
        ]);

        $nIdPersona    =   $request->nIdPersona;
        $cTipoPersona  =   $request->cTipoPersona;

        $arrayDirecciones = DB::select('exec [usp_Persona_GetDireccionesByPersona] ?, ?',
                                                    [
                                                        $nIdPersona,
                                                        $cTipoPersona
                                                    ]);

        //Obtener Tipo Persona
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
            $U_SYP_BPNO =   $request->contacto['cPrimerNombre'];
            $U_SYP_BPN2 =   $request->contacto['cSegundoNombre'];
            $U_SYP_BPTP =   "TPN";
            $U_SYP_BPTD =   "1";

            //explode — Divide un string en varios string separados por un criterio
            // $arrayNombres = explode(" ", $U_SYP_BPNO);
            // //Determina si existe mas de un nombre
            // $arrayNombresLength = sizeof($arrayNombres);
            // if($arrayNombresLength > 1) {
            //     $U_SYP_BPN2 =   $arrayNombres[1];
            // } else {
            //     $U_SYP_BPN2 =   " ";
            // }

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
                    "BPAddresses"   =>  array(),
                    // "BPAddresses"   => [
                    //     [
                    //         "AddressName"   =>  "Domicilio Fiscal",
                    //         "Street"        =>  $Address,
                    //         "Block"         =>  "Chachapoyas",
                    //         "ZipCode"       =>  "010101",
                    //         "City"          =>  "Chachapoyas",
                    //         "County"        =>  "Amazonas",
                    //         "Country"       =>  "PE",
                    //         "AddressType"   =>  "bo_BillTo",
                    //         "BPCode"        =>  $CardCode,
                    //     ],
                    //     [
                    //         "AddressName"   =>  "Domicilio Despacho",
                    //         "Street"        =>  $Address,
                    //         "Block"         =>  "Chachapoyas",
                    //         "ZipCode"       =>  "010101",
                    //         "City"          =>  "Chachapoyas",
                    //         "County"        =>  "Amazonas",
                    //         "Country"       =>  "PE",
                    //         "AddressType"   =>  "bo_ShipTo",
                    //         "BPCode"        =>  $CardCode
                    //     ]
                    // ]
                ]
            ];

            foreach ($arrayDirecciones as $key => $value) {
                $json['json']['BPAddresses'][] = [
                    "AddressName"   =>  $value->AddressName,
                    "Street"        =>  $value->Street,
                    "Block"         =>  $value->cU_SYP_DIST,
                    "ZipCode"       =>  $value->cUbigeo,
                    "City"          =>  $value->cU_SYP_PROV,
                    "County"        =>  $value->cU_SYP_DEPA,
                    "Country"       =>  "PE",
                    "AddressType"   =>  ($value->cTipoDireccion == 'F') ? "bo_BillTo" : "bo_ShipTo",
                    "BPCode"        =>  $CardCode
                ];
            }
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
                    "BPAddresses"   =>  array()
                ]
            ];
            foreach ($arrayDirecciones as $key => $value) {
                $json['json']['BPAddresses'][] = [
                    "AddressName"   =>  $value->AddressName,
                    "Street"        =>  $value->Street,
                    "Block"         =>  $value->cU_SYP_DIST,
                    "ZipCode"       =>  $value->cUbigeo,
                    "City"          =>  $value->cU_SYP_PROV,
                    "County"        =>  $value->cU_SYP_DEPA,
                    "Country"       =>  "PE",
                    "AddressType"   =>  ($value->cTipoDireccion == 'F') ? "bo_BillTo" : "bo_ShipTo",
                    "BPCode"        =>  $CardCode
                ];
            }
        }

        $response = $client->request('POST', "/pruebas/Contacto/SapSetContacto/", $json);
        return $response->getBody();
    }

    public function SapSetUpdDireccionesContacto(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            // 'base_uri'  => 'http://localhost:49454/'
            'base_uri'  => 'http://172.20.0.10:8020/'
        ]);

        $nIdPersona    =   $request->nIdPersona;
        $cTipoPersona  =   $request->cTipoPersona;

        $arrayDirecciones = DB::select('exec [usp_Persona_GetDireccionesByPersona] ?, ?',
                                                    [
                                                        $nIdPersona,
                                                        $cTipoPersona
                                                    ]);

        $json = [
            'json' => [
                "CardCode"      =>  $request->CardCode,
                "BPAddresses"   =>  array()
            ]
        ];
        foreach ($arrayDirecciones as $key => $value) {
            $json['json']['BPAddresses'][] = [
                "AddressName"   =>  $value->AddressName,
                "Street"        =>  $value->Street,
                "Block"         =>  $value->cU_SYP_DIST,
                "ZipCode"       =>  $value->cUbigeo,
                "City"          =>  $value->cU_SYP_PROV,
                "County"        =>  $value->cU_SYP_DEPA,
                "Country"       =>  "PE",
                "AddressType"   =>  ($value->cTipoDireccion == 'F') ? "bo_BillTo" : "bo_ShipTo",
                "BPCode"        =>  $request->CardCode
            ];
        }

        $response = $client->request('POST', "/pruebas/Contacto/SapSetContactoUpd/", $json);
        return $response->getBody();
    }

    public function SapSetContacto2(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => 'http://172.20.0.10:8020/'
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

        $response = $client->request('POST', "/pruebas/Contacto/SapSetContacto/", $json);
        return $response->getBody();
    }
}
