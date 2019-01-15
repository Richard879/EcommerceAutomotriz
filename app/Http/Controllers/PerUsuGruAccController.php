<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PerUsuGruAccController extends Controller
{
    public function GetListMenuByUsuario(Request $request)
    {
        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdUsuario = $request->nidusuario;
        $nLenJerarquia = $request->nlenjerarquia;

        $nIdSucursal = ($nIdSucursal == NULL) ? ($nIdSucursal = 0) : $nIdSucursal;

        $data = DB::select('exec [usp_Puga_GetListMenuByUsuario] ?, ?, ?, ?',
                                                        [   $nIdEmpresa,
                                                            $nIdSucursal,
                                                            $nIdUsuario,
                                                            $nLenJerarquia
                                                        ]);
        return response()->json($data);
    }

    public function GetLstUsuarios(Request $request)
    {
        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $cDescripcion = $request->cdescripcion;
        $cDescripcion = ($cDescripcion == NULL) ? ($cDescripcion = '') : $cDescripcion;

        $arrayUsuarios = DB::select('exec [usp_Puga_GetListUsuarios] ?, ?, ?',
                                                        [   $nIdEmpresa,
                                                            $nIdSucursal,
                                                            $cDescripcion
                                                        ]);

        $arrayUsuarios = ParametroController::arrayPaginator($arrayUsuarios, $request);
        return ['arrayUsuarios'=>$arrayUsuarios];
    }

    public function GetListPermisosByUsuario(Request $request)
    {
        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdUsuario = $request->nidusuario;
        $nLenJeraquia = $request->nlenjerarquia;

        $data = DB::select('exec [usp_Puga_GetListPermisosByUsuario] ?, ?, ?, ?',
                                                        [   $nIdEmpresa,
                                                            $nIdSucursal,
                                                            $nIdUsuario,
                                                            $nLenJeraquia
                                                        ]);
        return response()->json($data);
    }

    public function DeletePermisosByUsuario(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $element = DB::select('exec [usp_Puga_DeletePermisosByUsuario] ?, ?, ? ,? ,?',
                                                            [   $request->nIdEmpresa,
                                                                $request->nIdSucursal,
                                                                $request->nIdPerfil,
                                                                $request->nIdUsuario,
                                                                Auth::user()->id
                                                            ]);
        return response()->json($element);
    }

    public function SetPermisosByUsuario(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $detalles = $request->arrayData;
            foreach($detalles as $ep=>$det)
            {
                DB::select('exec [usp_Puga_SetPermisosByUsuario] ?, ?, ?, ?, ?, ?',
                                                            [   $request->nIdEmpresa,
                                                                $request->nIdSucursal,
                                                                $request->nIdPerfil,
                                                                $request->nIdUsuario,
                                                                $det['nIdMenu'],
                                                                Auth::user()->id
                                                            ]);
            }
            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function GetListUsuarios2(Request $request)
    {
        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $cDescripcion = $request->cdescripcion;
        $nIdGrupoPar = $request->nidgrupopar;

        $opcion = $request->opcion;

        $cDescripcion = ($cDescripcion == NULL) ? ($cDescripcion = '') : $cDescripcion;

        $arrayUsuarios = DB::select('exec [usp_Puga_GetListUsuarios2] ?, ?, ?, ?',
                                                        [   $nIdEmpresa,
                                                            $nIdSucursal,
                                                            $cDescripcion,
                                                            $nIdGrupoPar
                                                        ]);

        if($opcion == 1) {
            $arrayUsuarios = ParametroController::arrayPaginator($arrayUsuarios, $request);
            return ['arrayUsuarios'=>$arrayUsuarios];
        } else {
            return response()->json($arrayUsuarios);
        }
    }
}
