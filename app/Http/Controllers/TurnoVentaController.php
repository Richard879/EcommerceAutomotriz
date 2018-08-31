<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

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
}
