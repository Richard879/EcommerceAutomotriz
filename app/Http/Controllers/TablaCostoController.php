<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TablaCostoController extends Controller
{
    public function GetCompraTipoBeneficio(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdCompra = $request->nIdCompra;

        $data = DB::select('exec usp_TablaCosto_GetCompra_TipoBeneficio ?', [ $nIdCompra ]);

        return response()->json($data);
    }
}
