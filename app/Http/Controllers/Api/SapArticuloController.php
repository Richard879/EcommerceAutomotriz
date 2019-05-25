<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SapArticuloController extends Controller
{
    public function SapGetValidarArticulo(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => 'http://172.20.0.10:8020/'
        ]);

        $json = [
            'json' => [
                "ItemCode"    => $request->cNumeroVin
            ]
        ];

        $response = $client->request('POST', "/pruebas/Articulo/SapGetValidarArticulo/", $json);
        return $response->getBody();
    }

    public function SapSetArticulo(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => 'http://172.20.0.10:8020/'
        ]);

        $array_rpta = [];
        $rptaSap   = [];

        $data = $request->data;
        foreach ($data as $key => $value) {

            $cItemCode  =   $value['cNombreComercial'].' '.$value['nAnioVersion'].' '.$value['cNombreColor'];
            $ItemType   =   $value['cItemType'];
            $ItemType   =   ($ItemType == NULL) ? ($ItemType = 'itItems') : $ItemType;

            $json = [
                'json' => [
                    'U_SYP_FAMILIA'         =>  (string)$value['cNombreLinea'],
                    'U_SYP_SUBFAMILIA'      =>  "TP",
                    'U_SYP_MODELO'          =>  (string)$value['cNombreModelo'],
                    'U_SYP_VERSION'         =>  (string)$value['cNombreComercial'],
                    'U_SYP_AFAB'            =>  (string)$value['nAnioFabricacion'],
                    'U_SYP_AMOD'            =>  (string)$value['nAnioVersion'],
                    "ItemCode"              =>  (string)$value['cNumeroVin'],
                    "ItemName"              =>  (string)$cItemCode,
                    "ItemType"              =>  (string)$ItemType,
                    "ItemsGroupCode"        =>  "107",
                    "IndirectTax"           =>  "tYES", //General           =>  Impuesto Indirecto
                    "ManageSerialNumbers"   =>  "tYES", //General           =>  Articulo Gestiano Por
                    "ApTaxCode"             =>  "IGV",  //Datos Compras     =>  Indicador impuestos acreedores
                    "PurchaseUnit"          =>  "ZZ",   //Datos Compras     =>  Nombre de Unidad de Medida de Compras
                    "ArTaxCode"             =>  "IGV",  //Datos Ventas      =>  Indicador de IVA
                    "SalesUnit"             =>  "ZZ",   //Datos Ventas      =>  Nombre de Unidad de Medida de Ventas
                    "U_SYP_TIPEXIST"        =>  "01",   //Campos Usuario    =>  Tipo de Existencia
                    "U_SYP_TIPUNMED"        =>  "NIU",  //Campos Usuario    =>  Unidad Medida
                    "U_SYP_CATEXIST"        =>  "1",    //Campos Usuario    =>  Catalogo de Existencias
                    "U_SYP_CATEXIST1"       =>  "1"     //Campos Usuario    =>  Catalogo de Existencias - SUNAT
                ]
            ];

            $response = $client->request('POST', "/pruebas/Articulo/SapSetArticulo/", $json);
            $rptaSap = json_decode($response->getBody());
            array_push($array_rpta, $rptaSap);
        }
        return $array_rpta;
    }

    public function SapGetCostoPromedio(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => 'http://172.20.0.10:8020/'
        ]);

        $array_rpta = [];
        $rptaSap   = [];

        $arraySapElemento = $request->data;
        foreach ($arraySapElemento as $key => $value) {

            $nWhsCode     = $value['nWhsCode'];
            $cItemCode    = $value['cItemCode'];

            $response = $client->request('POST', "/pruebas/Articulo/SapGetCostoPromedio/", [
                                                                                        'query' => ['nWhsCode' => $nWhsCode,
                                                                                                    'cItemCode' => $cItemCode]
                                                                                    ]);
            $rptaSap = json_decode($response->getBody());
            //array_push($array_rpta, $rptaSap);
        }
        return $rptaSap;
    }

    public function SapSetSerialNumber(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => 'http://172.20.0.10:8020/'
        ]);

        /*$cItemCode    = $request->cItemCode;

        $response = $client->request('POST', "/pruebas/Articulo/SapSetSerialNumber/", [
                                                                        'query' => ['cItemCode' => $cItemCode]
                                                                      ]);
        return $response->getBody();*/

        $array_rpta = [];
        $rptaSap   = [];

        $data = $request->data;
        foreach ($data as $key => $value){

            $response = $client->request('POST', "/pruebas/Articulo/SapSetSerialNumber/", [
                                                                    'query' => ['cItemCode' => (string)$value['cNumeroVin'],
                                                                                'cItemName' => (string)$value['cNombreComercial']
                                                                                ]
                                                                            ]);

            $rptaSap = json_decode($response->getBody());
            array_push($array_rpta, $rptaSap);
        }
        return $array_rpta;
    }

    public function SapPatchArticulo(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => 'http://172.20.0.10:8020/'
        ]);

        $cNumeroVin         = $request->cNumeroVin;
        $cCodigoNaciones    = $request->cCodigoNaciones;

        $json = [
            'json' => [
                "ItemCode"      =>  (string)$cNumeroVin,
                'U_SYP_UNSPSC'  =>  (string)$cCodigoNaciones//Código Naciones Unidas
            ]
        ];

        $response = $client->request('POST', "/pruebas/Articulo/SapPatchArticulo/", $json);
        return $response->getBody();
    }

    public function SapGetArticulo(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => 'http://172.20.0.10:8020/'
        ]);

        $array_rpta = [];
        $rptaSap   = [];

        $data = $request->data;
        foreach ($data as $key => $value) {

            $json = [
                'json' => [
                    "ItemCode"  =>  (string)$value['cNumeroVin']
                ]
            ];

            $response = $client->request('POST', "/pruebas/Articulo/SapGetArticulo/", $json);
            $rptaSap = json_decode($response->getBody());
            array_push($array_rpta, $rptaSap);
        }
        return $array_rpta;
    }

    public function SapPatchArticuloAll(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => 'http://172.20.0.10:8020/'
        ]);

        // $cnroplaca              =   $request->fillNuevoVehiculo['cnroplaca'];
        // $cnrotarjetapropiedad   =   $request->fillNuevoVehiculo['cnrotarjetapropiedad'];
        $nidclase               =   $request->fillNuevoVehiculo['nidclase'];
        $nidmarca               =   $request->fillNuevoVehiculo['nidmarca'];
        $nidmodelo              =   $request->fillNuevoVehiculo['nidmodelo'];
        $cnombrecolor           =   $request->fillNuevoVehiculo['cnombrecolor'];
        $nidaniomodelo          =   $request->fillNuevoVehiculo['nidaniomodelo'];
        $nidtranccion           =   $request->fillNuevoVehiculo['nidtranccion'];
        $nidcategoria           =   $request->fillNuevoVehiculo['nidcategoria'];
        $nidcilindrada          =   $request->fillNuevoVehiculo['nidcilindrada'];
        $nidtransmision         =   $request->fillNuevoVehiculo['nidtransmision'];
        $nidcombustible         =   $request->fillNuevoVehiculo['nidcombustible'];
        $dfechaventa            =   $request->fillNuevoVehiculo['dfechaventa'];
        $cnromotor              =   $request->fillNuevoVehiculo['cnromotor'];
        //$cnumerodua             =   $request->fillNuevoVehiculo['cnumerodua'];
        $cnroserie              =   $request->fillNuevoVehiculo['cnroserie'];
        $cnrocilindros          =   $request->fillNuevoVehiculo['cnrocilindros'];
        $cnrorueda              =   $request->fillNuevoVehiculo['cnrorueda'];
        $cnroeje                =   $request->fillNuevoVehiculo['cnroeje'];
        $cpotencia              =   $request->fillNuevoVehiculo['cpotencia'];
        $cnropasajeros          =   $request->fillNuevoVehiculo['cnropasajeros'];
        $cnroasiento            =   $request->fillNuevoVehiculo['cnroasiento'];
        $cpesoseco              =   $request->fillNuevoVehiculo['fpesoseco'];
        $cpesobruto             =   $request->fillNuevoVehiculo['fpesobruto'];
        $clongitud              =   $request->fillNuevoVehiculo['flongitud'];
        $caltura                =   $request->fillNuevoVehiculo['faltura'];
        $cancho                 =   $request->fillNuevoVehiculo['fancho'];
        $ccargautil             =   $request->fillNuevoVehiculo['fcargautil'];
        $cnacionesunidas        =   $request->fillNuevoVehiculo['cnacionesunidas'];

        //=================== OBTENER LA MARCA DEL VEHÍCULO ===================
        $marca = DB::select('exec [usp_Par_GetParametroById] ?',
                                                                [
                                                                    $nidmarca
                                                                ]);
        $nidmarca = $marca[0]->cParNombre;//Setear por el Nombre


        //=================== OBTENER EL COLOR EXT DEL VEHÍCULO ===================
        /*$color = DB::select('exec [usp_Par_GetParametroById] ?',
                                                                [
                                                                    $nidcolor
                                                                ]);
        $nidcolor = $color[0]->cParNombre;//Setear por el Nombre*/


        //=================== OBTENER EL NOMBRE CILINDRADA DEL VEHÍCULO ===================
        /*$cilindrada = DB::select('exec [usp_Par_GetParametroById] ?',
                                                                [
                                                                    $nidcilindrada
                                                                ]);
        $nidcilindrada = $cilindrada[0]->cParNombre;//Setear por el Nombre*/


        //=================== OBTENER EL NOMBRE COMBUSTIBLE DEL VEHÍCULO ===================
        $combustible = DB::select('exec [usp_Par_GetParametroById] ?',
                                                                [
                                                                    $nidcombustible
                                                                ]);
        $nidcombustible = $combustible[0]->cParNombre;//Setear por el Nombre


         //=================== OBTENER EL NOMBRE DE TRACCIÓN ===================
         $ctraccion = DB::select('exec [usp_Par_GetParametroById] ?',
         [
             $nidtranccion
         ]);
         $nidtranccion = $ctraccion[0]->cParNombre;//Setear por el Nombre


        //=================== OBTENER EL NOMBRE DE LA CARROCERIA ===================
        $carroceria = DB::select('exec [usp_Par_GetParametroById] ?',
                                                                [
                                                                    $nidclase
                                                                ]);
        $nidclase = $carroceria[0]->cParNombre;//Setear por el Nombre

        //=================== OBTENER EL NOMBRE DE LA CATEGORIA ===================
        $categoria = DB::select('exec [usp_Par_GetParametroById] ?',
                                                                [
                                                                    $nidcategoria
                                                                ]);
        $nidcategoria = $categoria[0]->cParNombre;//Setear por el Nombre

        $json = [
            'json' => [
                "ItemCode"          =>  (string)$cnroserie,
                'U_SYP_MARCA'       =>  (string)$nidmarca,
                'U_SYP_CEXTERIOR'   =>  (string)$cnombrecolor,
                //'U_SYP_UNSPSC'      =>  (string)$cnacionesunidas,//Codigo Naciones Unidas
                'U_SYP_NROMOTOR'    =>  (string)$cnromotor,//Numero de Motor
                //'U_SYP_MDND'        =>  (string)$cnumerodua,//Numero de DUA
                'U_SYP_NROCHASIS'   =>  (string)$cnroserie,//Numero de Chasis
                'U_SYP_CILINDRADA'  =>  (string)$nidcilindrada,//Cilindrada
                'U_SYP_COMBUSTIBLE' =>  (string)$nidcombustible,//Combustible
                'U_SYP_NROCLINDRO'  =>  (string)$cnrocilindros,//Nro Cilindos
                'U_SYP_NROPASAJERO' =>  (string)$cnropasajeros,//Nro Pasajeros
                'U_SYP_NROASIENTO'  =>  (string)$cnroasiento,//Nro Asiento
                'U_SYP_NRORUEDA'    =>  (string)$cnrorueda,//Nro Rueda
                'U_SYP_PBRUTO'      =>  (string)$cpesobruto,//Nro Rueda
                'U_SYP_PSECO'       =>  (string)$cpesoseco,//Nro Rueda
                'U_SYP_ALTURA'      =>  (string)$caltura,//Nro Rueda
                'U_SYP_LONGITUD'    =>  (string)$clongitud,//Nro Rueda
                'U_SYP_ANCHO'       =>  (string)$cancho,//Nro Rueda
                'U_SYP_CUTIL'       =>  (string)$ccargautil,//Carga Util
                'U_SYP_CARR'        =>  (string)$nidclase,//Carroceria
                'U_SYP_PTNC'        =>  (string)$cpotencia,//Nro Potencia
                'U_SYP_FROD'        =>  (string)$nidtranccion,//Traccion
                'U_SYP_NEJE'        =>  (string)$cnroeje,//Nro Eje
                'U_SYP_CATE'        =>  (string)$nidcategoria,//Categoria
            ]
        ];

        $response = $client->request('POST', "/pruebas/Articulo/SapPatchArticulo/", $json);
        return $response->getBody();
    }
}
