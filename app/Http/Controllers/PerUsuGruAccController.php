<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PerUsuGruAccController extends Controller
{
    public function GetListPermisosByUser(Request $request)
    { 
        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->idsucursal;
        $nIdUsuario = $request->nidusuario;
        $nLenJerarquia = $request->nlenjerarquia;

        $arrayMenu = DB::select('exec [usp_Puga_GetListMenuByUser] ?, ?, ?, ?', 
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

        $data = DB::select('exec [usp_Puga_GetListPermisosByUsuario] ?, ?', 
                                                        [   $nIdUsuario,
                                                            $nLenJeraquia
                                                        ]);
        return response()->json($data);
        //$arrayPermisos = ParametroController::arrayPaginator($arrayPermisos, $request);
        //return ['arrayPermisos'=>$arrayPermisos];
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
}
