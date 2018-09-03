<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TurnoVentaController extends Controller
{
    public function arrayPaginator($array, $request)
    {
        $page = $request->page;
        $perPage = 10;
        $offset = ($page * $perPage) - $perPage;

        $array = new Collection($array);
        $result = $array->forPage($page, $perPage)->values()->all();
        return  new LengthAwarePaginator($result, $array->count(), $perPage,$page);
    }

    public function GetLstTurnoVenta(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdTurno = $request->nidturno;
        
        $arrayTurnoVenta = DB::select('exec usp_TurnoVentas_GetLstTurnoVenta ?, ?, ?', 
                                 array($nIdEmpresa, $nIdSucursal, $nIdTurno));

        $arrayTurnoVenta = $this->arrayPaginator($arrayTurnoVenta, $request);
        
         return ['arrayTurnoVenta'=>$arrayTurnoVenta];
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        $turnoventa = DB::select('exec usp_TurnoVenta_SetTurno ?, ?, ? ,? ,?, ?, ?, ?', 
                                                            array($request->nIdEmpresa,
                                                                    $request->nIdSucursal,
                                                                    $request->nIdTurno, 
                                                                    $request->cHoraInicio,
                                                                    $request->nIdHoraInicio,
                                                                    $request->cHoraFin,
                                                                    $request->nIdHoraFin,
                                                                    Auth::user()->id
                                                                    ));
        return response()->json($turnoventa);         
    }
    public function desactivar (Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $turnoventa = DB::select('exec usp_TurnoVenta_DesactivaById ?', 
                                array(  $request->nIdTurnoVenta ));
        return response()->json($turnoventa);   
    }

    public function activar (Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $turnoventa = DB::select('exec usp_TurnoVenta_ActivaById ?', 
                                array(  $request->nIdTurnoVenta ));
        return response()->json($turnoventa);   
    }
    public function UpdTurnoVentaById(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        $turnoventa = DB::select('exec usp_TurnoVenta_UpdTurnoVentaById ?, ?, ?, ?, ?, ?, ?, ?, ?', 
                                                            array($request->nIdTurnoVendedor,
                                                                    $request->nIdEmpresa,
                                                                    $request->nIdSucursal,
                                                                    $request->nIdTurno, 
                                                                    $request->cHoraInicio,
                                                                    $request->nIdHoraInicio,
                                                                    $request->cHoraFin,
                                                                    $request->nIdHoraFin,
                                                                    Auth::user()->id
                                                                    ));
        return response()->json($turnoventa);         
    }
}
