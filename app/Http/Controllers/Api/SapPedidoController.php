<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SapPedidoController extends Controller
{
    public function SapSetPedido(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => 'http://172.20.0.10/'
        ]);

        $data = DB::select('exec [usp_Usuario_GetEmpleadoByUsuario] ?',
                                                    [
                                                        Auth::user()->id
                                                    ]);
        // Obtener el EmployeeCode del Usuario Autenticado
        $nSalesEmployeeCode   =   $data[0]->nSalesEmployeeCode;

        // ======================================================================
        // GENERAR ORDEN VENTA PARA VEHÍCULO
        // ======================================================================
        //Setear arreglos para Pedido (Vehiculo)
        $arrayVehiculo  = [];
        $rptaSap        = [];

        $arraySapPedido = $request->arraySapPedido;
        foreach ($arraySapPedido as $key => $value) {

            $SubTotal = (floatval($value['fSubTotalDolares']) / floatval($request->Igv));

            $json = [
                'json' => [
                    "CardCode"          =>  $value['cCardCode'],
                    "DocDate"           =>  (string)$request->fDocDate,
                    "DocDueDate"        =>  (string)$request->fDocDueDate,
                    "DocCurrency"       =>  "US$",
                    "DocTotal"          =>  (string)$value['fSubTotalDolares'],
                    "SalesPersonCode"   =>  (string)$nSalesEmployeeCode,
                    "DocumentLines" => [
                        [
                            "ItemCode"      =>  $value['cNumeroVin'],
                            "Quantity"      =>  "1",
                            "TaxCode"       =>  "IGV",
                            "UnitPrice"     =>  (string)$SubTotal,
                            "Currency"      =>  "US$",
                            "WarehouseCode" =>  (string)$request->WarehouseCode,
                            'SerialNumbers' =>  array()
                            /*IF(NDOCENTRMERCANCIA<>0)
                            [
                                [
                                    "SerialNumbers" => [
                                        [
                                            "ManufacturerSerialNumber"  =>  (string)$value['cNumeroVin'],
                                            "InternalSerialNumber"      =>  (string)$value['cNumeroVin']
                                        ]
                                    ]
                                ]
                            ],*/
                        ]
                    ]
                ]
            ];

            //Verificar la Entrada De Mercancia
            if($value['nDocEntryMercancia']) {
                //Agrgar informacion en el Array correspondiente
                $json['json']['DocumentLines'][0]['SerialNumbers'] = [
                    "ManufacturerSerialNumber"  =>  (string)$value['cNumeroVin'],
                    "InternalSerialNumber"      =>  (string)$value['cNumeroVin'],
                ];
            } else {
                $json['json']['DocumentLines'][0]['SerialNumbers'] = [];
            }

            $response = $client->request('POST', "/api/Pedido/SapSetPedido/", $json);
            $rptaSap = json_decode($response->getBody());
            array_push($arrayVehiculo, $rptaSap);
        }

        // ======================================================================
        // GENERAR ORDEN VENTA PARA LOS ELEMENTOS DE VENTA
        // ======================================================================
        //Setear arreglos para Pedido (Elemento Venta)
        $arrayEV  = [];
        $rptaSap  = [];

        //Obtener el numero de Elemento Venta encontrados
        $arraySAPEVPedidoLength = sizeof($request->arraySapEVPedido);
        //Verifica si existen Elemento Venta
        if($arraySAPEVPedidoLength > 0) {
            //Guardar Arreglo de Ele. Venta
            $arraySapEVPedido = $request->arraySapEVPedido;

            $json = [
                'json' => [
                    "CardCode"          =>  '',
                    "DocDate"           =>  (string)$request->fDocDate,
                    "DocDueDate"        =>  (string)$request->fDocDueDate,
                    "DocCurrency"       =>  "US$",
                    "DocTotal"          =>  '',
                    "SalesPersonCode"   =>  (string)$nSalesEmployeeCode,
                    "DocumentLines"     =>  array()
                ]
            ];

            //Setear el acumulador del DocTotal
            $fMontoTotal = 0;

            //Recorrer todos los Elementos de Venta
            foreach ($arraySapEVPedido as $key => $value) {
                // Setear CardCode
                $json['json']['CardCode'] = $value['cCardCode'];

                // Obtener el Monto sin IGV
                $SubTotal = (floatval($value['fSubTotalDolares']) / floatval($request->Igv));

                // Setear DocumentLines
                $json['json']['DocumentLines'][] = [
                    "ItemCode"  =>  $value['cCodigoERP'],
                    "Quantity"  =>  $value['nCantidad'],
                    "TaxCode"   =>  "IGV",
                    "UnitPrice" =>  (string)$SubTotal,
                    "Currency"  =>  "US$"
                ];

                //Acumulador para setear en el DocTotal
                $fMontoTotal = $fMontoTotal + floatval($value['fSubTotalDolares']);
            }

            // Setear DocTotal
            $json['json']['DocTotal'] = (string)$fMontoTotal;

            $response = $client->request('POST', "/api/Pedido/SapSetPedido/", $json);
            $rptaSap = json_decode($response->getBody());
            array_push($arrayEV, $rptaSap);
        }

        return [
            'arrayVehiculo' =>  $arrayVehiculo,
            'arrayEV'       =>  $arrayEV
        ];
    }

    public function SapSetPedidoDscto(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            // 'base_uri'  => 'http://localhost:49454/'
            'base_uri'  => 'http://172.20.0.10/'
        ]);

        $nIdCabeceraPedido  =   $request->nIdCabeceraPedido;
        $data = DB::select('exec [usp_Pedido_GetNumDsctosPedidoHistorial] ?',
                                                            [
                                                                $nIdCabeceraPedido,
                                                            ]);

        $nDocEntryPedido    =   $request->nDocEntryPedido;
        $cCardCode          =   $request->cCardCode;
        $cItemCode          =   $request->cItemCode;
        //Calcular nuevo dscto
        $dMontoNuevoDolares =   $request->dMontoNuevoDolares;
        $dMontoNuevoDolares =   round($dMontoNuevoDolares, 2);
        $dMontoDescontar    =   $request->dMontoDescontar;
        $dFechaModificacion =   $request->dFechaModificacion;


        // Obtener el Total Porcentaje Historico
        $nPorcentajeHistorial   =   $data[0]->nCantPorcentaje;
        // Sumar el Porcentaje Historico + el Porcentaje Enviado
        $nPorcentajeTotal       =   $nPorcentajeHistorial + $dMontoDescontar;

        $json = [
            'json' => [
                "DocEntryPedido"    => (string)$nDocEntryPedido,
                "CardCode"          => (string)$cCardCode,
                "DocTotal"          => (string)$dMontoNuevoDolares,
                "Comments"          => (string)$dFechaModificacion,
                "DocumentLines" => [
                    [
                        "DiscountPercent"   => (string)$nPorcentajeTotal
                    ]
                ]
            ]
        ];

        $response = $client->request('POST', "/api/Pedido/SapSetPedidoDscto/", $json);
        return $response->getBody();
    }
}
