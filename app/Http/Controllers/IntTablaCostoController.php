<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IntTablaCostoController extends Controller
{
    public function GetCompraTC(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa     = $request->nIdEmpresa;
        $nIdSucursal    = $request->nIdSucursal;
        $nIdCronograma  = $request->nIdCronograma;

        $array_infoTipoBeneficio    =   [];
        $array_infoCostoVehiculo    =   [];

        $data = $request->data;
        foreach ($data as $key => $value) {
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
                $U_SYP_VIN          =   '';
                $U_SYP_CCONCEPTO    =   '';
                $U_SYP_DCONCEPTO    =   '';
                $U_SYP_CDOCUMENTO   =   '';
                $U_SYP_DDOCUMENTO   =   '';
                $U_SYP_IMPORTE      =   '';
                $U_SYP_COSTO        =   '';
                $U_SYP_ESTADO       =   '';

                //Si es un Objetivo de Tipo Compra
                if ($beneficio->cFlagTipoOperacion == 'C') {
                    $U_SYP_VIN = $beneficio->cNumeroVin;
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
                    'U_SYP_VIN'         =>  $U_SYP_VIN,
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
            $U_SYP_VIN          =   $costovehiculo->cNumeroVin;
            $U_SYP_CCONCEPTO    =   $costovehiculo->U_SYP_CCONCEPTO;
            $U_SYP_DCONCEPTO    =   $costovehiculo->U_SYP_DCONCEPTO;
            $U_SYP_CDOCUMENTO   =   $costovehiculo->U_SYP_CDOCUMENTO;
            $U_SYP_DDOCUMENTO   =   $costovehiculo->U_SYP_DDOCUMENTO;
            $U_SYP_IMPORTE      =   $costovehiculo->fTotalCompra;
            $U_SYP_COSTO        =   $costovehiculo->U_SYP_COSTO;
            $U_SYP_ESTADO       =   $costovehiculo->U_SYP_ESTADO;

            $infoCostoVehiculo = [
                'U_SYP_VIN'         =>  $U_SYP_VIN,
                'U_SYP_CCONCEPTO'   =>  $U_SYP_CCONCEPTO,
                'U_SYP_DCONCEPTO'   =>  $U_SYP_DCONCEPTO,
                'U_SYP_CDOCUMENTO'  =>  $U_SYP_CDOCUMENTO,
                'U_SYP_DDOCUMENTO'  =>  $U_SYP_DDOCUMENTO,
                'U_SYP_IMPORTE'     =>  $U_SYP_IMPORTE,
                'U_SYP_COSTO'       =>  $U_SYP_COSTO,
                'U_SYP_ESTADO'      =>  $U_SYP_ESTADO
            ];
            array_push($array_infoCostoVehiculo, $infoCostoVehiculo);
        }

        $tblCostos = [
            'array_infoTipoBeneficio' =>  $array_infoTipoBeneficio,
            'array_infoCostoVehiculo' =>  $array_infoCostoVehiculo
        ];

        return response()->json($tblCostos);
    }

    public function SetIntegraTblCostoCab(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $detalles = $request->data;
            foreach($detalles as $ep=>$det)
            {
                $objTablaCosto = DB::select('exec [usp_Integra_SetIntegraTblCostoCab] ?, ?, ?, ?',
                                                            [   $det['nDocEntry'],
                                                                $det['cU_SYP_VIN'],
                                                                $det['cLogRespuesta'],
                                                                Auth::user()->id
                                                            ]);
            }
            DB::commit();
            return response()->json($objTablaCosto);
        } catch (Exception $e){
            DB::rollBack();
        }
    }
}
