<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class EntregaVehiculoController extends Controller
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

    public function GetLstInspecciones(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa  = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdVehiculo  = $request->nidvehiculo;
        $dFechaSolicitud  = $request->dfechaSolicitud;
        $nIdEstado  = $request->nidestado;

        $nIdVehiculo  = ($nIdVehiculo == NULL) ? ($nIdVehiculo = ' ') : $nIdVehiculo;
        $dFechaSolicitud  = ($dFechaSolicitud == NULL) ? ($dFechaSolicitud = ' ') : $dFechaSolicitud;
        $nIdEstado  = ($nIdEstado == NULL) ? ($nIdEstado = ' ') : $nIdEstado;

        $arrayInspeccionesAprobadas = DB::select('exec usp_EntregaVehiculo_GetLstInspecciones ?, ?, ?, ?, ?, ?',
                                                            [
                                                                $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $nIdVehiculo,
                                                                $dFechaSolicitud,
                                                                $nIdEstado,
                                                                Auth::user()->id
                                                            ]);

        $arrayInspeccionesAprobadas = $this->arrayPaginator($arrayInspeccionesAprobadas, $request);
        return ['arrayInspeccionesAprobadas'=>$arrayInspeccionesAprobadas];
    }
}
