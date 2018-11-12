<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PerRelacionController extends Controller
{
    public function GetLstEmpresaByUsuario(Request $request)
    {
        $nIdUsuario = $request->nidusuario;

        $arrayEmpresa = DB::select('exec [usp_PerRelacion_GetLstEmpresaByUsuario] ?',
                                            [   $nIdUsuario
                                            ]);
        return response()->json($arrayEmpresa);
    }

    public function GetLstSucursalByEmpresa(Request $request)
    {
        $nIdUsuario = $request->nidusuario;
        $nIdEmpresa = $request->nidempresa;

        $arraySucursal = DB::select('exec [usp_PerRelacion_GetLstSucursalByEmpresa] ?, ?',
                                            [   $nIdUsuario,
                                                $nIdEmpresa
                                            ]);
        return response()->json($arraySucursal);
    }
}
