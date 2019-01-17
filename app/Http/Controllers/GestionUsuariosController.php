<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GestionUsuariosController extends Controller
{
    public function GetListUsuarios(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $cDescripcion = $request->cdescripcion;

        $opcion = $request->opcion;

        $cDescripcion = ($cDescripcion == NULL) ? ($cDescripcion = '') : $cDescripcion;

        $arrayUsuarios = DB::select('exec usp_Usuario_GetListUsuarios ?, ?, ?',
                                                            [
                                                                $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $cDescripcion
                                                            ]);

        if($opcion == 1) {
            $arrayUsuarios = ParametroController::arrayPaginator($arrayUsuarios, $request);
            return ['arrayUsuarios'=>$arrayUsuarios];
        } else {
            return response()->json($arrayUsuarios);
        }
    }
}
