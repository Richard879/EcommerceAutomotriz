<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerUsuGruAccController extends Controller
{
    public function GetListPermisosByUser(Request $request)
    { 
        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->idsucursal;
        $nIdUsuario = $request->nidusuario;
        $nLenJerarquia = $request->nlenjerarquia;

        $arrayMenu = DB::select('exec [usp_PerUsuGruAcc_GetListPermisosByUser] ?, ?, ?, ?', 
                                                        [   $nIdEmpresa,
                                                            $nIdSucursal,
                                                            $nIdUsuario,
                                                            $nLenJerarquia
                                                        ]);

        $arrayMenu = ParametroController::arrayPaginator($arrayMenu, $request);
        return ['arrayMenu'=>$arrayMenu];
    }

    public function GetLstUsuarios(Request $request)
    { 
        $nIdEmpresa = $request->nidempresa;

        $arrayUsuarios = DB::select('exec [usp_Puga_GetListUsuarios] ?', 
                                                        [   $nIdEmpresa
                                                        ]);

        $arrayUsuarios = ParametroController::arrayPaginator($arrayUsuarios, $request);
        return ['arrayUsuarios'=>$arrayUsuarios];
    }

    public function GetListPermisosByUsuario(Request $request)
    { 
        $nIdUsuario = $request->nidusuario;
        $nLenJeraquia = $request->nlenjerarquia;

        $arrayPermisos = DB::select('exec [usp_Puga_GetListPermisosByUsuario] ?, ?', 
                                                        [   $nIdUsuario,
                                                            $nLenJeraquia
                                                        ]);

        $arrayPermisos = ParametroController::arrayPaginator($arrayPermisos, $request);
        return ['arrayPermisos'=>$arrayPermisos];
    }
}
