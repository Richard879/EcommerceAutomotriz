<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SapArticuloController extends Controller
{
    public function SapGetValidarArticulo(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => 'http://172.20.0.10/'
        ]);

        $json = [
                    'json' => [
                        "ItemCode"    => $request->cNumeroVin
                        ]
                ];

        $response = $client->request('POST', "/api/Articulo/SapGetValidarArticulo/", $json);
        return $response->getBody();
    }

    public function SapSetArticulo(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => 'http://172.20.0.10/'
        ]);

        $array_rpta = [];
        $rptaSap   = [];

        $data = $request->data;
        foreach ($data as $key => $value) {

            $cItemCode  =   $value['cNombreComercial'].' '.$value['nAnioFabricacion'].' '.$value['nAnioVersion'];
            $ItemType   =   $value['cItemType'];
            $ItemType   =   ($ItemType == NULL) ? ($ItemType = 'itItems') : $ItemType;

            $json = [
                'json' => [
                    "ItemCode"              =>  $value['cNumeroVin'],
                    "ItemName"              =>  $cItemCode,
                    "ItemType"              =>  $ItemType,
                    "ItemsGroupCode"        =>  "107",
                    "IndirectTax"           =>  "tYES", //General           =>  Impuesto Directo
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

            $response = $client->request('POST', "/api/Articulo/SapSetArticulo/", $json);
            $rptaSap = json_decode($response->getBody());
            array_push($array_rpta, $rptaSap);
        }
        return $array_rpta;
    }

    public function SapGetCostoPromedio()
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => 'http://172.20.0.10/'
        ]);
        
        $array_rpta = [];
        $rptaSap   = [];
        
        $arraySapElemento = $request->arraySapElemento;
        foreach ($arraySapElemento as $key => $value) {

            $nWhsCode     = $value['nIdAlmacen'];
            $cItemCode    = $value['cItemCode'];

            $response = $client->request('POST', "/api/Articulo/SapGetCostoPromedio/", [
                                                                                        'query' => ['nWhsCode' => $nWhsCode,
                                                                                                    'cItemCode' => $cItemCode]
                                                                                    ]);
            $rptaSap = json_decode($response->getBody());
            array_push($array_rpta, $rptaSap);
        }
        return $array_rpta;
    }
}
