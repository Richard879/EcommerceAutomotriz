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
        $nIdCompra      = $request->nIdCompra;

        // ==================================================================================
        // =======================  TIPO DE BENEFICIO ================================
        $data = DB::select('exec usp_TablaCosto_GetCompra_TipoBeneficio ?, ?, ?, ?',
                                                [
                                                    $nIdEmpresa,
                                                    $nIdSucursal,
                                                    $nIdCronograma,
                                                    $nIdCompra
                                                ]);

        $incentivo = $data[0];
        $U_SYP_CCONCEPTO = '';
        $U_SYP_DCONCEPTO = '';
        $U_SYP_CDOCUMENTO = '';
        $U_SYP_DDOCUMENTO = '';
        $U_SYP_IMPORTE = '';
        $U_SYP_COSTO = '';
        $U_SYP_ESTADO = '';

        if ($incentivo->cFlagTipoOperacion == 'C') {
            //Bono
            if($incentivo->cFlagTipoBeneficio == 'B') {
                //CONCETPO
                $U_SYP_CCONCEPTO = '01';
                $U_SYP_DCONCEPTO = 'Bono';
                //DOCUMENTO
                $U_SYP_CDOCUMENTO = '01';
                $U_SYP_DDOCUMENTO = 'Nota de Crédito';
                //IMPORTE
                $U_SYP_IMPORTE = $incentivo->fValorBeneficio;
                //COSTO
                $U_SYP_COSTO = 'Si';
                //Estado
                $U_SYP_ESTADO = 'Pendiente';
            }
            //Beneficio
            if($incentivo->cFlagTipoBeneficio == 'E') {
                //CONCETPO
                $U_SYP_CCONCEPTO = '02';
                $U_SYP_DCONCEPTO = 'Beneficio';
                //DOCUMENTO
                $U_SYP_CDOCUMENTO = '01';
                $U_SYP_DDOCUMENTO = 'Nota de Crédito';
                //IMPORTE
                $U_SYP_IMPORTE = $incentivo->fValorBeneficio;
                //COSTO
                $U_SYP_COSTO = 'Si';
                //Estado
                $U_SYP_ESTADO = 'Pendiente';
            }
            //Incentivo
            if($incentivo->cFlagTipoBeneficio == 'I') {
                //CONCETPO
                $U_SYP_CCONCEPTO = '03';
                $U_SYP_DCONCEPTO = 'Incentivo';
                //DOCUMENTO
                $U_SYP_CDOCUMENTO = '04';
                $U_SYP_DDOCUMENTO = 'Por Facturar';
                //IMPORTE
                $U_SYP_IMPORTE = $incentivo->fValorBeneficio;
                //COSTO
                $U_SYP_COSTO = 'No';
                //Estado
                $U_SYP_ESTADO = 'Pendiente';
            }
        }

        $infoTipoBeneficio = [
            'U_SYP_CCONCEPTO'   =>  $U_SYP_CCONCEPTO,
            'U_SYP_DCONCEPTO'   =>  $U_SYP_DCONCEPTO,
            'U_SYP_CDOCUMENTO'  =>  $U_SYP_CDOCUMENTO,
            'U_SYP_DDOCUMENTO'  =>  $U_SYP_DDOCUMENTO,
            'U_SYP_IMPORTE'     =>  $U_SYP_IMPORTE,
            'U_SYP_COSTO'       =>  $U_SYP_COSTO,
            'U_SYP_ESTADO'      =>  $U_SYP_ESTADO
        ];

        // ==================================================================================
        // =============================  COSTO DEL VEHICULO ================================
        $data = DB::select('exec usp_TablaCosto_GetCompra_CostoVehiculo ?, ?, ?, ?',
                                                [
                                                    $nIdEmpresa,
                                                    $nIdSucursal,
                                                    $nIdCronograma,
                                                    $nIdCompra
                                                ]);

        $compra = $data[0];
        $U_SYP_CCONCEPTO = '04';
        $U_SYP_DCONCEPTO = 'Costo de Vehículo';
        $U_SYP_CDOCUMENTO = '02';
        $U_SYP_DDOCUMENTO = 'Factura Proveedor';
        $U_SYP_IMPORTE = $compra->fTotalCompra;
        $U_SYP_COSTO = 'Si';
        $U_SYP_ESTADO = 'Pendiente';

        $infoCompra = [
            'U_SYP_CCONCEPTO'   =>  $U_SYP_CCONCEPTO,
            'U_SYP_DCONCEPTO'   =>  $U_SYP_DCONCEPTO,
            'U_SYP_CDOCUMENTO'  =>  $U_SYP_CDOCUMENTO,
            'U_SYP_DDOCUMENTO'  =>  $U_SYP_DDOCUMENTO,
            'U_SYP_IMPORTE'     =>  $U_SYP_IMPORTE,
            'U_SYP_COSTO'       =>  $U_SYP_COSTO,
            'U_SYP_ESTADO'      =>  $U_SYP_ESTADO
        ];

        // ==================================================================================
        // =============================  COSTO DEL VEHICULO ================================
        $data = DB::select('exec usp_TablaCosto_GetCompra_Flete ?, ?, ?',
                                                [
                                                    $nIdEmpresa,
                                                    $nIdSucursal,
                                                    $nIdCompra
                                                ]);

        $flete = $data[0];
        $U_SYP_CCONCEPTO = '05';
        $U_SYP_DCONCEPTO = 'Flete';
        $U_SYP_CDOCUMENTO = '02';
        $U_SYP_DDOCUMENTO = 'Factura Proveedor';
        $U_SYP_IMPORTE = $flete->fImporteFleteSinIgv;
        $U_SYP_COSTO = 'Si';
        $U_SYP_ESTADO = 'Pendiente';

        $infoFlete = [
            'U_SYP_CCONCEPTO'   =>  $U_SYP_CCONCEPTO,
            'U_SYP_DCONCEPTO'   =>  $U_SYP_DCONCEPTO,
            'U_SYP_CDOCUMENTO'  =>  $U_SYP_CDOCUMENTO,
            'U_SYP_DDOCUMENTO'  =>  $U_SYP_DDOCUMENTO,
            'U_SYP_IMPORTE'     =>  $U_SYP_IMPORTE,
            'U_SYP_COSTO'       =>  $U_SYP_COSTO,
            'U_SYP_ESTADO'      =>  $U_SYP_ESTADO
        ];

        $tblCostos = [
            'infoTipoBeneficio' =>  $infoTipoBeneficio,
            'infoCompra'        =>  $infoCompra,
            'infoFlete'         =>  $infoFlete
        ];

        return response()->json($tblCostos);
    }
}
