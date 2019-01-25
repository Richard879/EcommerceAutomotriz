<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
}
