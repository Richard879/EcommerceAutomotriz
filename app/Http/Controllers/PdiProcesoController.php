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
}
