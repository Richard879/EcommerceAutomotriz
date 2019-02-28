<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AlmacenController extends Controller
{
    public function GetAlmacenPorDefecto(Request $request)
    {
        $nIdPar = $request->nidpar;
        $nIdGrupoPar = $request->nidgrupopar;

        $data = DB::select('exec [usp_Almacen_GetAlmacenPorDefecto] ?, ?',
                                                [   $nIdPar,
                                                    $nIdGrupoPar
                                                ]);

        return response()->json($data);
    }

    public function GetAlmacenByLocalidad(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        $nIdSucursal   = $request->nidsucursal;
        $variable   = $request->opcion;

        $nIdSucursal = ($nIdSucursal == NULL) ? ($nIdSucursal = 0) : $nIdSucursal;
        $variable = ($variable == NULL) ? ($variable = 0) : $variable;
                
        $arraySucursal = DB::select('exec [usp_Almacen_GetAlmacenByLocalidad] ?', 
                                                                [   $nIdSucursal
                                                                ]);

        if($variable == "0"){
            $arraySucursal = ParametroController::arrayPaginator($arraySucursal, $request);
        }
        return ['arraySucursal'=>$arraySucursal];
    }
}
