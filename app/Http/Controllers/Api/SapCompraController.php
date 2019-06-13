<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SapCompraController extends Controller
{
    /*public function GetListComprasByIdAPI()
    {
        $client = new Client([
            'base_uri' => 'http://172.20.6.54/',// URI Ejem: https://jsonplaceholder.typicode.com
        ]);

        $response = $client->request('GET', "/Sap/pruebas/Compra/GetListCompraByVin");

        $posts = json_decode($response->getBody()->getContents());
        return $posts;
    }*/

    ////=================== SERVER PUBLISH =====================
    //'base_uri' => 'http://172.20.0.10:8020/'
    //$response = $client->request('POST', "/pruebas/Compra/SapSetCompra", $json);
    ////=================== LOCAL SERVER =====================
    //'base_uri' => 'http://172.20.6.55/'
    //$response = $client->request('POST', "/Sap/pruebas/Compra/SapSetCompra/", $json);
    ////=================== LOCAL DEBUG =====================
    //'base_uri' => 'http://localhost:49454/'
    //$response = $client->request('POST', "/pruebas/Compra/SapSetCompra/", $json);

    /// ============================================================
    /// METODOS SERVICES LAYER
    /// ============================================================
    ///
    public function SapSetCompra(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => 'http://172.20.0.10:8020/'
        ]);

        //======= Obtener el EmployeeCode del Usuario Autenticado
        $data = DB::select('exec [usp_Usuario_GetEmpleadoByUsuario] ?',
                                                [   Auth::user()->id
                                                ]);
        $nSalesEmployeeCode   =   $data[0]->nSalesEmployeeCode;
        //============================================================

        $array_rpta = [];
        $rptaSap   = [];

        $data = $request->data;
        foreach ($data as $key => $value) {
            $value['fTotalCompra']= str_replace(",", "", $value['fTotalCompra']);

            $json = [
                'json' => [
                    "CardCode"          =>  $request->cCardCode,
                    "DocDate"           =>  (string)$request->fDocDate,
                    "DocDueDate"        =>  (string)$request->fDocDueDate,
                    "DocCurrency"       =>  "US$",
                    "SalesPersonCode"   =>  (string)$nSalesEmployeeCode,
                    "U_SYP_MDMT"        =>  "01",
                    "U_SYP_TCOMPRA"     =>  "01",
                    "DocumentLines" => [
                            [
                                "ItemCode"          => (string)$value['cNumeroVin'],
                                "Quantity"          => "1",
                                "TaxCode"           => "IGV",
                                "PriceAfterVAT"     => (string)$value['fTotalCompra'],
                                "Currency"          => "US$",
                                "WarehouseCode"     => (string)$request->cWarehouseCode,
                                "ProjectCode"       => (string)$value['cNumeroVin'],
                                "CostingCode2"      =>  "01", //UnidadDeNegocio
                                "CostingCode3"      =>  (string)$request->nIdSapSucursal, //Codigo Sap Sucursal
                                "U_SYP_TPOIMP"      =>   "01"
                            ]
                        ]
                    ]
                ];

            $response = $client->request('POST', "/pruebas/Compra/SapSetCompra/", $json);
            $rptaSap = json_decode($response->getBody());
            array_push($array_rpta, $rptaSap);
        }
        return $array_rpta;
    }

    public function SapPatchCompra(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => 'http://172.20.0.10:8020/'
        ]);

        $nDocEntry          = $request->nDocEntry;
        $cSerieComprobante  = $request->cSerieComprobante;
        $cNumeroComprobante = $request->cNumeroComprobante;
        $nIdCompra          = $request->nIdCompra;
        $cNumeroDua         = $request->cNumeroDua;
        $dFechaDua          = $request->dFechaDua;
        $cNumeroMotor       = $request->cNumeroMotor;
        $cNombreColor       = $request->cNombreColor;

        $json = [
            'json' => [
                "DocEntry"          =>  (string)$nDocEntry,
                'U_SYP_MDSD'        =>  (string)$cSerieComprobante, //Serie del Documento
                'U_SYP_MDCD'        =>  (string)$cNumeroComprobante,//Correlativo del Documento
                'U_SYP_NOCCLIENTE'  =>  (string)$nIdCompra,         //Correlativo del Documento
                'U_SYP_MDND'        =>  (string)$cNumeroDua,        //Numero de DUA
                'U_SYP_CDAD'        =>  "055",                      //Codigo Aduana
                'U_SYP_MDFD'        =>  (string)$dFechaDua,         //Fecha de DUA
            ]
        ];

        $response = $client->request('POST', "/pruebas/Compra/SapPatchCompra/", $json);
        return $response->getBody();
    }

    public function SapSetCompraServicio(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => 'http://172.20.0.10:8020/'
        ]);

        //======= Obtener el EmployeeCode del Usuario Autenticado
        $data = DB::select('exec [usp_Usuario_GetEmpleadoByUsuario] ?',
                                            [   Auth::user()->id
                                            ]);
        $nSalesEmployeeCode   =   $data[0]->nSalesEmployeeCode;
        //============================================================

        $array_rpta = [];
        $rptaSap   = [];
        //$ReceptionDate              =   date('Y-m-d');

        $data = $request->data;
        foreach ($data as $key => $value) {
            $json = [
                'json' => [
                    "CardCode"          =>  $request->cCardCode,
                    "DocDate"           =>  (string)$request->fDocDate,
                    "DocDueDate"        =>  (string)$request->fDocDueDate,
                    "DocCurrency"       =>  "US$",
                    "DocType"           =>  "dDocument_Service",
                    "SalesPersonCode"   =>  (string)$nSalesEmployeeCode,
                    "U_SYP_MDMT"        =>  "01",
                    "U_SYP_TCOMPRA"     =>  "01",
                    "DocumentLines" => [
                            [
                                "ItemDescription"   =>  "Comisión por Manejo Línea",
                                "TaxCode"           => "IGV",
                                "PriceAfterVAT"     => (string)$value['fTotalCompra'],
                                "Currency"          => "US$",
                                "AccountCode"       =>  (string)$cAccountCode,
                                //"WarehouseCode"     => (string)$request->cWarehouseCode,
                                "ProjectCode"       => (string)$value['cNumeroVin']
                            ]
                        ]
                    ]
                ];

            $response = $client->request('POST', "/pruebas/Compra/SapSetCompra/", $json);
            $rptaSap = json_decode($response->getBody());
            array_push($array_rpta, $rptaSap);
        }
        return $array_rpta;
    }

    public function SapSetFacturaProveedorCompra(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => 'http://172.20.0.10:8020/'
        ]);

        $array_rpta = [];
        $rptaSap   = [];
        $ReceptionDate  = date('Y-m-d');

        //======= Obtener el EmployeeCode del Usuario Autenticado
        $data = DB::select('exec [usp_Usuario_GetEmpleadoByUsuario] ?',
        [   Auth::user()->id
        ]);
        $nSalesEmployeeCode   =   $data[0]->nSalesEmployeeCode;
        //============================================================


        $data = $request->data;
        foreach ($data as $key => $value) {

            $json = [
                'json' => [
                    "CardCode"          =>  $request->cCardCode,
                    "DocDate"           =>  (string)$request->fDocDate,
                    "DocDueDate"        =>  (string)$request->fDocDueDate,
                    "DocCurrency"       =>  "US$",
                    "SalesPersonCode"   =>  (string)$nSalesEmployeeCode,
                    "U_SYP_MDMT"        =>  "02",
                    "U_SYP_MDTD"        =>  "01",
                    "U_SYP_MDSD"        =>  (string)$value['cSerieComprobante'],
                    "U_SYP_MDCD"        =>  (string)$value['cNumeroComprobante'],
                    "DocumentLines"     =>  [
                        [
                            "ItemCode"          => (string)$value['cNumeroVin'],
                            "Quantity"          => "1",
                            "TaxCode"           => "IGV",
                            "PriceAfterVAT"     => (string)$value['fTotalCompra'],
                            "Currency"          => "US$",
                            "WarehouseCode"     => (string)$request->cWarehouseCode,
                            "ProjectCode"       => (string)$value['cNumeroVin'],
                            "CostingCode2"      =>  "01", //UnidadDeNegocio
                            "CostingCode3"      =>  (string)$request->nIdSapSucursal, //Codigo Sap Sucursal
                            "U_SYP_TPOIMP"      =>   "01",
                            'SerialNumbers'     =>  array()
                        ]
                    ]
                ]
            ];

            $json['json']['DocumentLines'][0]['SerialNumbers'] = [
                [
                    "ItemCode"              =>  (string)$value['cNumeroVin'],
                    "DistNumber"            =>  (string)$value['cNumeroVin'],
                    "SysNumber"             =>  1,
                    "InDate"                =>  $ReceptionDate/*,
                    "ExpiryDate"                =>  null,
                    "ManufactureDate"           =>  null,
                    "ReceptionDate"             =>  $ReceptionDate,
                    "WarrantyStart"             =>  null,
                    "WarrantyEnd"               =>  null,
                    "Location"                  =>  null,
                    "Notes"                     =>  null,
                    "BatchID"                   =>  null,
                    "SystemSerialNumber"        =>  1,
                    "BaseLineNumber"            =>  0,
                    "Quantity"                  =>  1,
                    "TrackingNote"              =>  null,
                    "TrackingNoteLine"          =>  null*/
                ]
            ];

            $response = $client->request('POST', "/pruebas/Comprobante/SapSetFacturaProveedor/", $json);
            $rptaSap = json_decode($response->getBody());
            array_push($array_rpta, $rptaSap);
        }
        return $array_rpta;
    }
}
