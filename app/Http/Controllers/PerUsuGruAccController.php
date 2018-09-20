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
}
