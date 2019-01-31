<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TablaCostoController extends Controller
{
    public function GetCompraTC(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa     = $request->nIdEmpresa;
        $nIdSucursal    = $request->nIdSucursal;
        $nIdCronograma  = $request->nIdCronograma;

        $array_infoTipoBeneficio    =   [];
        $array_infoCostoVehiculo    =   [];
        $array_infoFlete            =   [];

        $arraySapArticulo = $request->arraySapArticulo;
        foreach ($arraySapArticulo as $value) {
            // ==================================================================================
            // =======================  TIPO DE BENEFICIO ================================
            $data = DB::select('exec usp_TablaCosto_GetCompra_TipoBeneficio ?, ?, ?, ?',
                                                    [
                                                        $nIdEmpresa,
                                                        $nIdSucursal,
                                                        $nIdCronograma,
                                                        $value['cNumeroVin']
                                                    ]);

            if ($data) {
                $beneficio = $data[0];
                $VIN                =   '';
                $U_SYP_CCONCEPTO    =   '';
                $U_SYP_DCONCEPTO    =   '';
                $U_SYP_CDOCUMENTO   =   '';
                $U_SYP_DDOCUMENTO   =   '';
                $U_SYP_IMPORTE      =   '';
                $U_SYP_COSTO        =   '';
                $U_SYP_ESTADO       =   '';

                //Si es un Objetivo de Tipo Compra
                if ($beneficio->cFlagTipoOperacion == 'C') {
                    $VIN = $beneficio->cNumeroVin;
                    //Bono
                    if($beneficio->cFlagTipoBeneficio == 'B') {
                        //CONCETPO
                        $U_SYP_CCONCEPTO = '01';
                        $U_SYP_DCONCEPTO = 'Bono';
                        //DOCUMENTO
                        $U_SYP_CDOCUMENTO = '01';
                        $U_SYP_DDOCUMENTO = 'Nota de Crédito';
                        //IMPORTE
                        $U_SYP_IMPORTE = $beneficio->fValorBeneficio;
                        //COSTO
                        $U_SYP_COSTO = 'Si';
                        //Estado
                        $U_SYP_ESTADO = 'Pendiente';
                    }
                    //Beneficio
                    if($beneficio->cFlagTipoBeneficio == 'E') {
                        //CONCETPO
                        $U_SYP_CCONCEPTO = '02';
                        $U_SYP_DCONCEPTO = 'Beneficio';
                        //DOCUMENTO
                        $U_SYP_CDOCUMENTO = '01';
                        $U_SYP_DDOCUMENTO = 'Nota de Crédito';
                        //IMPORTE
                        $U_SYP_IMPORTE = $beneficio->fValorBeneficio;
                        //COSTO
                        $U_SYP_COSTO = 'Si';
                        //Estado
                        $U_SYP_ESTADO = 'Pendiente';
                    }
                    //Incentivo
                    if($beneficio->cFlagTipoBeneficio == 'I') {
                        //CONCETPO
                        $U_SYP_CCONCEPTO = '03';
                        $U_SYP_DCONCEPTO = 'Incentivo';
                        //DOCUMENTO
                        $U_SYP_CDOCUMENTO = '04';
                        $U_SYP_DDOCUMENTO = 'Por Facturar';
                        //IMPORTE
                        $U_SYP_IMPORTE = $beneficio->fValorBeneficio;
                        //COSTO
                        $U_SYP_COSTO = 'No';
                        //Estado
                        $U_SYP_ESTADO = 'Pendiente';
                    }
                }

                $infoTipoBeneficio = [
                    'VIN'               =>  $VIN,
                    'U_SYP_CCONCEPTO'   =>  $U_SYP_CCONCEPTO,
                    'U_SYP_DCONCEPTO'   =>  $U_SYP_DCONCEPTO,
                    'U_SYP_CDOCUMENTO'  =>  $U_SYP_CDOCUMENTO,
                    'U_SYP_DDOCUMENTO'  =>  $U_SYP_DDOCUMENTO,
                    'U_SYP_IMPORTE'     =>  $U_SYP_IMPORTE,
                    'U_SYP_COSTO'       =>  $U_SYP_COSTO,
                    'U_SYP_ESTADO'      =>  $U_SYP_ESTADO
                ];
                array_push($array_infoTipoBeneficio, $infoTipoBeneficio);
            }

            // ==================================================================================
            // =============================  COSTO DEL VEHICULO ================================
            $data = DB::select('exec usp_TablaCosto_GetCompra_CostoVehiculo ?, ?, ?, ?',
                                                    [
                                                        $nIdEmpresa,
                                                        $nIdSucursal,
                                                        $nIdCronograma,
                                                        $value['cNumeroVin']
                                                    ]);

            $costovehiculo = $data[0];
            $VIN                =   $costovehiculo->cNumeroVin;
            $U_SYP_CCONCEPTO    =   '04';
            $U_SYP_DCONCEPTO    =   'Costo de Vehículo';
            $U_SYP_CDOCUMENTO   =   '02';
            $U_SYP_DDOCUMENTO   =   'Factura Proveedor';
            $U_SYP_IMPORTE      =   $costovehiculo->fTotalCompra;
            $U_SYP_COSTO        =   'Si';
            $U_SYP_ESTADO       =   'Pendiente';

            $infoCostoVehiculo = [
                'VIN'               =>  $VIN,
                'U_SYP_CCONCEPTO'   =>  $U_SYP_CCONCEPTO,
                'U_SYP_DCONCEPTO'   =>  $U_SYP_DCONCEPTO,
                'U_SYP_CDOCUMENTO'  =>  $U_SYP_CDOCUMENTO,
                'U_SYP_DDOCUMENTO'  =>  $U_SYP_DDOCUMENTO,
                'U_SYP_IMPORTE'     =>  $U_SYP_IMPORTE,
                'U_SYP_COSTO'       =>  $U_SYP_COSTO,
                'U_SYP_ESTADO'      =>  $U_SYP_ESTADO
            ];
            array_push($array_infoCostoVehiculo, $infoCostoVehiculo);

            // ==================================================================================
            // =============================  FLETE =============================================
            $data = DB::select('exec usp_TablaCosto_GetCompra_Flete ?, ?, ?',
                                                    [
                                                        $nIdEmpresa,
                                                        $nIdSucursal,
                                                        $value['cNumeroVin']
                                                    ]);

            if ($data) {
                $flete = $data[0];
                $VIN                =   $flete->cNumeroVin;
                $U_SYP_CCONCEPTO    =   '05';
                $U_SYP_DCONCEPTO    =   'Flete';
                $U_SYP_CDOCUMENTO   =   '02';
                $U_SYP_DDOCUMENTO   =   'Factura Proveedor';
                $U_SYP_IMPORTE      =   $flete->fImporteFleteSinIgv;
                $U_SYP_COSTO        =   'Si';
                $U_SYP_ESTADO       =   'Pendiente';

                $infoFlete = [
                    'VIN'               =>  $VIN,
                    'U_SYP_CCONCEPTO'   =>  $U_SYP_CCONCEPTO,
                    'U_SYP_DCONCEPTO'   =>  $U_SYP_DCONCEPTO,
                    'U_SYP_CDOCUMENTO'  =>  $U_SYP_CDOCUMENTO,
                    'U_SYP_DDOCUMENTO'  =>  $U_SYP_DDOCUMENTO,
                    'U_SYP_IMPORTE'     =>  $U_SYP_IMPORTE,
                    'U_SYP_COSTO'       =>  $U_SYP_COSTO,
                    'U_SYP_ESTADO'      =>  $U_SYP_ESTADO
                ];
                array_push($array_infoFlete, $infoFlete);
            }
        }

        $tblCostos = [
            'array_infoTipoBeneficio' =>  $array_infoTipoBeneficio,
            'array_infoCostoVehiculo' =>  $array_infoCostoVehiculo,
            'array_infoFlete'         =>  $array_infoFlete
        ];

        return response()->json($tblCostos);
    }
}
