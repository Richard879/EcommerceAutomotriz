<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TurnoVentaController extends Controller
{
    public function GetLstTurnoVenta(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdTurno = $request->nidturno;

        $arrayTurnoVenta = DB::select('exec [usp_TurnoVenta_GetLstTurnoVenta] ?, ?, ?',
                                            [   $nIdEmpresa, 
                                                $nIdSucursal, 
                                                $nIdTurno
                                            ]);

        $arrayTurnoVenta = ParametroController::arrayPaginator($arrayTurnoVenta, $request);

         return ['arrayTurnoVenta'=>$arrayTurnoVenta];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $turnoventa = DB::select('exec usp_TurnoVenta_SetTurno ?, ?, ? ,? ,?, ?',
                                                            array($request->nIdEmpresa,
                                                                    $request->nIdSucursal,
                                                                    $request->nIdTurno,
                                                                    $request->cHoraInicio,
                                                                    $request->cHoraFin,
                                                                    Auth::user()->id
                                                                    ));
        return response()->json($turnoventa);
    }

    public function desactivar (Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $turnoventa = DB::select('exec usp_TurnoVenta_DesactivaById ?, ?',
                                [   $request->nIdTurnoVenta,
                                    Auth::user()->id
                                ]);
        return response()->json($turnoventa);
    }

    public function activar (Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $turnoventa = DB::select('exec usp_TurnoVenta_ActivaById ?, ?',
                                [   $request->nIdTurnoVenta,
                                    Auth::user()->id
                                ]);
        return response()->json($turnoventa);
    }
    
    public function UpdTurnoVentaById(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $turnoventa = DB::select('exec usp_TurnoVenta_UpdTurnoVentaById ?, ?, ?, ?, ?, ?, ?',
                                                            array($request->nIdTurnoVendedor,
                                                                    $request->nIdEmpresa,
                                                                    $request->nIdSucursal,
                                                                    $request->nIdTurno,
                                                                    $request->cHoraInicio,
                                                                    $request->cHoraFin,
                                                                    Auth::user()->id
                                                                    ));
        return response()->json($turnoventa);
    }
}
