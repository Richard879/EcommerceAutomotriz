<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AlmacenController extends Controller
{
    public function GetListAlmacen(Request $request)
    {
        $nIdLocalidad  = $request->nIdLocalidad;
        $nIdAlmacen    = $request->nIdAlmacen;
        $nCodigoCuenta = $request->nCodigoCuenta;

        $nIdLocalidad   = ($nIdLocalidad == NULL) ? ($nIdLocalidad = 0) : $nIdLocalidad;
        $nIdAlmacen     = ($nIdAlmacen == NULL) ? ($nIdAlmacen = 0) : $nIdAlmacen;
        $nCodigoCuenta  = ($nCodigoCuenta == NULL) ? ($nCodigoCuenta = ' ') : $nCodigoCuenta;

        $data = DB::select('exec [usp_Almacen_GetListAlmacen] ?, ?, ?',
                                                [   $nIdLocalidad,
                                                    $nIdAlmacen,
                                                    $nCodigoCuenta
                                                ]);

        $arrayAlmacen = ParametroController::arrayPaginator($data, $request);
        return ['arrayAlmacen'=>$arrayAlmacen];
    }

    public function GetAlmacen(Request $request)
    {
        $data = DB::select('exec [usp_Almacen_GetAlmacen]');

        return response()->json($data);
    }

    public function GetAlmacenPorDefecto(Request $request)
    {
        $nIdPar         = $request->nidpar;
        $nIdGrupoPar    = $request->nidgrupopar;

        $data = DB::select('exec [usp_Almacen_GetAlmacenPorDefecto] ?, ?',
                                                [   $nIdPar,
                                                    $nIdGrupoPar
                                                ]);

        return response()->json($data);
    }

    public function GetAlmacenByLocalidad(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdLocalidad   = $request->nidlocalidad;
        $variable       = $request->opcion;

        $nIdLocalidad   = ($nIdLocalidad == NULL) ? ($nIdLocalidad = 0) : $nIdLocalidad;
        $variable       = ($variable == NULL) ? ($variable = 0) : $variable;

        $arrayAlmacen = DB::select('exec [usp_Almacen_GetAlmacenByLocalidad] ?',
                                                                [   $nIdLocalidad
                                                                ]);

        if($variable == "0"){
            $arrayAlmacen = ParametroController::arrayPaginator($arrayAlmacen, $request);
        }
        return ['arrayAlmacen'=>$arrayAlmacen];
    }

    public function SetRegistrarAlmacen(Request $request)
    {
        $nIdLocalidad  = $request->nIdLocalidad;
        $nIdAlmacen    = $request->nIdAlmacen;
        $nCodigoCuenta = $request->nCodigoCuenta;

        $nIdLocalidad   = ($nIdLocalidad == NULL) ? ($nIdLocalidad = 0) : $nIdLocalidad;
        $nIdAlmacen     = ($nIdAlmacen == NULL) ? ($nIdAlmacen = 0) : $nIdAlmacen;
        $nCodigoCuenta  = ($nCodigoCuenta == NULL) ? ($nCodigoCuenta = ' ') : $nCodigoCuenta;

        $data = DB::select('exec [usp_Almacen_SetRegistrarAlmacen] ?, ?, ?, ?',
                                                [   $nIdLocalidad,
                                                    $nIdAlmacen,
                                                    $nCodigoCuenta,
                                                    Auth::user()->id
                                                ]);

        return response()->json($data);
    }

    public function SetCambiarEstado(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdLocalidad   =   $request->nIdLocalidad;
        $nIdAlmacen     =   $request->nIdAlmacen;
        $nCodigoCuenta  =   $request->nCodigoCuenta;
        $nIdUsuario     =   Auth::user()->id;

        $estado     = ($request->opcion == 0) ? ($estado = 'D') : ($estado = 'A');

        $usuario = DB::select('exec usp_Almacen_SetCambiarEstado ?, ?, ?, ?',
                                                    [
                                                        $nIdLocalidad,
                                                        $nIdAlmacen,
                                                        $nCodigoCuenta,
                                                        $estado,
                                                        $nIdUsuario
                                                    ]);
        return response()->json($usuario);
    }

    public function SetActualizarAlmacen(Request $request)
    {
        $nIdLocalidad       = $request->nIdLocalidad;
        $nIdAlmacen         = $request->nIdAlmacen;
        $nCodigoCuenta      = $request->nCodigoCuenta;
        $nIdAlmacenAntiguo  = $request->nIdAlmacenAntiguo;

        $nIdLocalidad       = ($nIdLocalidad == NULL) ? ($nIdLocalidad = 0) : $nIdLocalidad;
        $nIdAlmacen         = ($nIdAlmacen == NULL) ? ($nIdAlmacen = 0) : $nIdAlmacen;
        $nCodigoCuenta      = ($nCodigoCuenta == NULL) ? ($nCodigoCuenta = ' ') : $nCodigoCuenta;
        $nIdAlmacenAntiguo  = ($nIdAlmacenAntiguo == NULL) ? ($nIdAlmacenAntiguo = 0) : $nIdAlmacenAntiguo;

        $data = DB::select('exec [usp_Almacen_SetActualizarAlmacen] ?, ?, ?, ?, ?',
                                                [   $nIdLocalidad,
                                                    $nIdAlmacen,
                                                    $nCodigoCuenta,
                                                    $nIdAlmacenAntiguo,
                                                    Auth::user()->id
                                                ]);

        return response()->json($data);
    }
}
