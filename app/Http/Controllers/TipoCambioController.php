<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TipoCambioController extends Controller
{
    public function GetTipoCambioById(Request $request)
    {
        $nIdTipoTransaccion = $request->nidtipotransaccion;

        $objTipoCambio = DB::select('exec [usp_TipoCambio_GetTipoCambioById] ?', [$nIdTipoTransaccion]);

        return response()->json($objTipoCambio);
    }

    public function GetTipoCambioDay(Request $request)
    {
        $objTipoCambio = DB::select('exec [usp_TipoCambio_GetTipoCambio]');

        return response()->json($objTipoCambio);
    }

    public function SetRegistrarTipoCambio(Request $request)
    {
        $dFechaTipoCambio       =   $request->dFechaTipoCambio;
        $fTipoCambioComercial   =   $request->fTipoCambioComercial;
        $fTipoCambioCompra      =   $request->fTipoCambioCompra;
        $fTipoCambioVenta       =   $request->fTipoCambioVenta;

        $data = DB::select('exec [usp_TipoCambio_SetRegistrarTipoCambio] ?, ?, ?, ?, ?',
                                                            [
                                                                $dFechaTipoCambio,
                                                                $fTipoCambioComercial,
                                                                $fTipoCambioCompra,
                                                                $fTipoCambioVenta,
                                                                Auth::user()->id
                                                            ]);

        return response()->json($data);
    }

    public function SetActualizarTipoCambio(Request $request)
    {
        $dFechaTipoCambio       =   $request->dFechaTipoCambio;
        $fTipoCambioComercial   =   $request->fTipoCambioComercial;
        $fTipoCambioCompra      =   $request->fTipoCambioCompra;
        $fTipoCambioVenta       =   $request->fTipoCambioVenta;

        $data = DB::select('exec [usp_TipoCambio_SetActualizarTipoCambio] ?, ?, ?, ?, ?',
                                                            [
                                                                $dFechaTipoCambio,
                                                                $fTipoCambioComercial,
                                                                $fTipoCambioCompra,
                                                                $fTipoCambioVenta,
                                                                Auth::user()->id
                                                            ]);

        return response()->json($data);
    }
}
