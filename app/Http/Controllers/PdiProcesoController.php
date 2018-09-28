<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PdiProcesoController extends Controller
{
    public function GetListSolicitudByEstado(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        $nIdEmpresa  = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdEstadoSolicitud = $request->nidestadosolicitud;
                
        $arraySolicitud = DB::select('exec [usp_Pdi_GetListSolicitudByEstado] ?, ?, ?', 
                                                                    [   $nIdEmpresa, 
                                                                        $nIdSucursal,
                                                                        $nIdEstadoSolicitud
                                                                    ]);

        $arraySolicitud = ParametroController::arrayPaginator($arraySolicitud, $request);
        return ['arraySolicitud'=>$arraySolicitud];
    }

    public function GetListCompra(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $dFechaInicio = $request->dfechainicio;
        $dFechaFin = $request->dfechafin;
        $nOrdenCompra = $request->nordencompra;
        $cNumeroVin = $request->cnumerovin;
        $nIdMarca   = $request->nidmarca;
        $nIdModelo  = $request->nidmodelo;
        $cNumeroVin = ($cNumeroVin == NULL) ? ($cNumeroVin = ' ') : $cNumeroVin;

        $arrayCompra = DB::select('exec [usp_Pdi_GetListCompra] ?, ?, ?, ?, ?, ?, ?, ?',
                                                            [   $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $dFechaInicio,
                                                                $dFechaFin,
                                                                $nOrdenCompra,
                                                                $cNumeroVin,
                                                                $nIdMarca,
                                                                $nIdModelo
                                                            ]);

        $arrayCompra = Parametro::arrayPaginator($arrayCompra, $request);
        return ['arrayCompra'=>$arrayCompra];
    }

    public function GetListSeccion(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        $nIdEmpresa   = $request->nidempresa;
        $nIdTipoInspeccion = $request->nidtipoinspeccion;
        $nIdFlag = $request->nidflag;
                
        $arraySeccion = DB::select('exec [usp_Pdi_GetListSeccion] ?, ?, ?', 
                                                                    [   $nIdEmpresa, 
                                                                        $nIdTipoInspeccion,
                                                                        $nIdFlag
                                                                    ]);
        return response()->json($arraySeccion);
    }

    public function GetListItem(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        $nIdEmpresa   = $request->nidempresa;
        $nIdTipoInspeccion = $request->nidtipoinspeccion;
        $nIdFlag = $request->nidflag;
                
        $arrayItems = DB::select('exec [usp_Pdi_GetListItem] ?, ?, ?', 
                                                                    [   $nIdEmpresa, 
                                                                        $nIdTipoInspeccion,
                                                                        $nIdFlag
                                                                    ]);
        return response()->json($arrayItems);
    }
}
