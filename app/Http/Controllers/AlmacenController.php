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
 
        $nIdLocalidad  = $request->nidlocalidad;
        $variable   = $request->opcion;

        $nIdLocalidad = ($nIdLocalidad == NULL) ? ($nIdLocalidad = 0) : $nIdLocalidad;
        $variable = ($variable == NULL) ? ($variable = 0) : $variable;
                
        $arrayAlmacen = DB::select('exec [usp_Almacen_GetAlmacenByLocalidad] ?', 
                                                                [   $nIdLocalidad
                                                                ]);

        if($variable == "0"){
            $arrayAlmacen = ParametroController::arrayPaginator($arrayAlmacen, $request);
        }
        return ['arrayAlmacen'=>$arrayAlmacen];
    }
}
