<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class TipoCambioController extends Controller
{
    public function GetTipoCambioById(Request $request)
    {
        $nIdTipoTransaccion = $request->nidtipotransaccion;

        $tipocambio = DB::select('exec usp_TipoCambio_GetTipoCambioById ?', [$nIdTipoTransaccion]);

        return response()->json($tipocambio);
    }
}
