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
            $data = DB::select('exec [usp_TablaCosto_GetCompra_TipoBeneficio] ?, ?, ?, ?',
                                                    [   $nIdEmpresa,
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
                        $U_SYP_CCONCEPTO = $beneficio->U_SYP_CCONCEPTO;
                        $U_SYP_DCONCEPTO = $beneficio->U_SYP_DCONCEPTO;
                        //DOCUMENTO
                        $U_SYP_CDOCUMENTO = $beneficio->U_SYP_CDOCUMENTO;
                        $U_SYP_DDOCUMENTO = $beneficio->U_SYP_DDOCUMENTO;
                        //IMPORTE
                        $U_SYP_IMPORTE = $beneficio->fValorBeneficio;
                        //COSTO
                        $U_SYP_COSTO = $beneficio->U_SYP_COSTO;
                        //Estado
                        $U_SYP_ESTADO = $beneficio->U_SYP_ESTADO;
                    }
                    //Beneficio
                    if($beneficio->cFlagTipoBeneficio == 'E') {
                        //CONCETPO
                        $U_SYP_CCONCEPTO = $beneficio->U_SYP_CCONCEPTO;
                        $U_SYP_DCONCEPTO = $beneficio->U_SYP_DCONCEPTO;
                        //DOCUMENTO
                        $U_SYP_CDOCUMENTO = $beneficio->U_SYP_CDOCUMENTO;
                        $U_SYP_DDOCUMENTO = $beneficio->U_SYP_DDOCUMENTO;
                        //IMPORTE
                        $U_SYP_IMPORTE = $beneficio->fValorBeneficio;
                        //COSTO
                        $U_SYP_COSTO = $beneficio->U_SYP_COSTO;
                        //Estado
                        $U_SYP_ESTADO = $beneficio->U_SYP_ESTADO;
                    }
                    //Incentivo
                    if($beneficio->cFlagTipoBeneficio == 'I') {
                        //CONCETPO
                        $U_SYP_CCONCEPTO = $beneficio->U_SYP_CCONCEPTO;
                        $U_SYP_DCONCEPTO = $beneficio->U_SYP_DCONCEPTO;
                        //DOCUMENTO
                        $U_SYP_CDOCUMENTO = $beneficio->U_SYP_CDOCUMENTO;
                        $U_SYP_DDOCUMENTO = $beneficio->U_SYP_DDOCUMENTO;
                        //IMPORTE
                        $U_SYP_IMPORTE = $beneficio->fValorBeneficio;
                        //COSTO
                        $U_SYP_COSTO = $beneficio->U_SYP_COSTO;
                        //Estado
                        $U_SYP_ESTADO = $beneficio->U_SYP_ESTADO;
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
            $data = DB::select('exec [usp_TablaCosto_GetCompra_CostoVehiculo] ?, ?, ?, ?',
                                                    [   $nIdEmpresa,
                                                        $nIdSucursal,
                                                        $nIdCronograma,
                                                        $value['cNumeroVin']
                                                    ]);

            $costovehiculo = $data[0];
            $VIN                =   $costovehiculo->cNumeroVin;
            $U_SYP_CCONCEPTO    =   $costovehiculo->U_SYP_CCONCEPTO;
            $U_SYP_DCONCEPTO    =   $costovehiculo->U_SYP_DCONCEPTO;
            $U_SYP_CDOCUMENTO   =   $costovehiculo->U_SYP_CDOCUMENTO;
            $U_SYP_DDOCUMENTO   =   $costovehiculo->U_SYP_DDOCUMENTO;
            $U_SYP_IMPORTE      =   $costovehiculo->fTotalCompra;
            $U_SYP_COSTO        =   $costovehiculo->U_SYP_COSTO;
            $U_SYP_ESTADO       =   $costovehiculo->U_SYP_ESTADO;

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
            $data = DB::select('exec [usp_TablaCosto_GetCompra_Flete] ?, ?, ?',
                                                    [   $nIdEmpresa,
                                                        $nIdSucursal,
                                                        $value['cNumeroVin']
                                                    ]);

            if ($data) {
                $flete = $data[0];
                $VIN                =   $flete->cNumeroVin;
                $U_SYP_CCONCEPTO    =   $flete->U_SYP_CCONCEPTO;
                $U_SYP_DCONCEPTO    =   $flete->U_SYP_DCONCEPTO;
                $U_SYP_CDOCUMENTO   =   $flete->U_SYP_CDOCUMENTO;
                $U_SYP_DDOCUMENTO   =   $flete->U_SYP_DDOCUMENTO;
                $U_SYP_IMPORTE      =   $flete->fImporteFleteSinIgv;
                $U_SYP_COSTO        =   $flete->U_SYP_COSTO;
                $U_SYP_ESTADO       =   $flete->U_SYP_ESTADO;

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
