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
        $nIdLocalidad           = $request->nIdLocalidad;
        $nIdAlmacen             = $request->nIdAlmacen;
        $nCodigoCuentaEntrada   = $request->nCodigoCuentaEntrada;
        $nCodigoCuentaSalida    = $request->nCodigoCuentaSalida;

        $nIdLocalidad           = ($nIdLocalidad == NULL) ? ($nIdLocalidad = 0) : $nIdLocalidad;
        $nIdAlmacen             = ($nIdAlmacen == NULL) ? ($nIdAlmacen = 0) : $nIdAlmacen;
        $nCodigoCuentaEntrada   = ($nCodigoCuentaEntrada == NULL) ? ($nCodigoCuentaEntrada = ' ') : $nCodigoCuentaEntrada;
        $nCodigoCuentaSalida    = ($nCodigoCuentaSalida == NULL) ? ($nCodigoCuentaSalida = ' ') : $nCodigoCuentaSalida;

        $data = DB::select('exec [usp_Almacen_GetListAlmacen] ?, ?, ?, ?',
                                                [   $nIdLocalidad,
                                                    $nIdAlmacen,
                                                    $nCodigoCuentaEntrada,
                                                    $nCodigoCuentaSalida
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
        $nIdSucursal    = $request->nidsucursal;
        $cFlagTipo      = $request->cflagtipo;

        $data = DB::select('exec [usp_Almacen_GetAlmacenPorDefecto] ?, ?',
                                                [   $nIdSucursal,
                                                    $cFlagTipo
                                                ]);

        return response()->json($data);
    }

    public function GetAlmacenByLocalidad(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdSucursal   = $request->nidsucursal;
        $variable       = $request->opcion;

        $nIdSucursal   = ($nIdSucursal == NULL) ? ($nIdSucursal = 0) : $nIdSucursal;
        $variable       = ($variable == NULL) ? ($variable = 0) : $variable;

        $arrayAlmacen = DB::select('exec [usp_Almacen_GetAlmacenByLocalidad] ?',
                                                                [   $nIdSucursal
                                                                ]);

        if($variable == "0"){
            $arrayAlmacen = ParametroController::arrayPaginator($arrayAlmacen, $request);
        }
        return ['arrayAlmacen'=>$arrayAlmacen];
    }

    public function SetRegistrarAlmacen(Request $request)
    {
        $nIdLocalidad           = $request->nIdLocalidad;
        $nIdAlmacen             = $request->nIdAlmacen;
        $nCodigoCuentaEntrada   = $request->nCodigoCuentaEntrada;
        $nCodigoCuentaSalida    = $request->nCodigoCuentaSalida;

        $nIdLocalidad           = ($nIdLocalidad == NULL) ? ($nIdLocalidad = 0) : $nIdLocalidad;
        $nIdAlmacen             = ($nIdAlmacen == NULL) ? ($nIdAlmacen = 0) : $nIdAlmacen;
        $nCodigoCuentaEntrada   = ($nCodigoCuentaEntrada == NULL) ? ($nCodigoCuentaEntrada = ' ') : $nCodigoCuentaEntrada;
        $nCodigoCuentaSalida    = ($nCodigoCuentaSalida == NULL) ? ($nCodigoCuentaSalida = ' ') : $nCodigoCuentaSalida;

        $data = DB::select('exec [usp_Almacen_SetRegistrarAlmacen] ?, ?, ?, ?, ?',
                                                [   $nIdLocalidad,
                                                    $nIdAlmacen,
                                                    $nCodigoCuentaEntrada,
                                                    $nCodigoCuentaSalida,
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
        $nId                    = $request->nId;
        $nIdLocalidad           = $request->nIdLocalidad;
        $nIdAlmacen             = $request->nIdAlmacen;
        $nCodigoCuentaEntrada   = $request->nCodigoCuentaEntrada;
        $nCodigoCuentaSalida    = $request->nCodigoCuentaSalida;

        $nId                    = ($nId == NULL) ? ($nId = 0) : $nId;
        $nIdLocalidad           = ($nIdLocalidad == NULL) ? ($nIdLocalidad = 0) : $nIdLocalidad;
        $nIdAlmacen             = ($nIdAlmacen == NULL) ? ($nIdAlmacen = 0) : $nIdAlmacen;
        $nCodigoCuentaEntrada   = ($nCodigoCuentaEntrada == NULL) ? ($nCodigoCuentaEntrada = ' ') : $nCodigoCuentaEntrada;
        $nCodigoCuentaSalida    = ($nCodigoCuentaSalida == NULL) ? ($nCodigoCuentaSalida = ' ') : $nCodigoCuentaSalida;

        $data = DB::select('exec [usp_Almacen_SetActualizarAlmacen] ?, ?, ?, ?, ?, ?',
                                                [
                                                    $nId,
                                                    $nIdLocalidad,
                                                    $nIdAlmacen,
                                                    $nCodigoCuentaEntrada,
                                                    $nCodigoCuentaSalida,
                                                    Auth::user()->id
                                                ]);

        return response()->json($data);
    }
}
