<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // ======================================================================
    // OBTENER LA CANTIDAD USUARIOS POR UN ROL EN ESPECIFICO
    // ======================================================================
    public function GetEmpleadosByRol(Request $request)
    {
        $nidrol = $request->nidrol;

        $dashboard = DB::select('EXEC usp_Dashboard_GetEmpleadosByRol ?',
                                                        [
                                                            $nidrol
                                                        ]);

        return response()->json($dashboard);
    }

    // ======================================================================
    // OBTENER EL NÚMERO DE COTIZACIONES POR USUARIO AUTENTICADO/POR MES
    // ======================================================================
    public function GetCotizacionesByUsuario(Request $request)
    {
        $nIdUsuario = $request->nIdUsuario;
        $dfecha     = $request->dfecha;

        $nIdUsuario = ($nIdUsuario == NULL) ? ($nIdUsuario = 0) : $nIdUsuario;

        $dashboard = DB::select('EXEC usp_Dashboard_GetCotizacionesByUsuario ?, ?',
                                                        [
                                                            $nIdUsuario,
                                                            $dfecha
                                                        ]);

        return response()->json($dashboard);
    }

    // ======================================================================
    // OBTENER EL NÚMERO DE COTIZACIONES POR ROL AUTENTICADO/POR MES
    // ======================================================================
    public function GetCotizacionesByRol(Request $request)
    {
        $nIdRol     = $request->nIdRol;
        $dfecha     = $request->dfecha;

        $dashboard = DB::select('EXEC usp_Dashboard_GetCotizacionesByRol ?, ?',
                                                        [
                                                            $nIdRol,
                                                            $dfecha
                                                        ]);

        return response()->json($dashboard);
    }

    // ======================================================================
    // OBTENER INFORMACIÓN DE USUARIOS POR SU SUPERVISOR
    // ======================================================================
    public function GetAsesoresByJV(Request $request)
    {
        $nIdUsuario = $request->nIdUsuario;

        $dashboard = DB::select('EXEC usp_Dashboard_GetAsesoresByRol ?',
                                                        [
                                                            $nIdUsuario
                                                        ]);

        return response()->json($dashboard);
    }

    // ======================================================================
    // OBTENER LAS COTIZACIONES DE TODOS LOS ASESORES DE UN JV EN ESPECIFICO
    // ======================================================================
    public function GetCotizacionesPorAsesorComercialDeJVEspecifico(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $dfecha     = $request->dfecha;

            $array_rpta = [];
            $arrayUsuariosLength = sizeof($request->arrayUsuarios);
            if($arrayUsuariosLength > 0) {
                $data = $request->arrayUsuarios;
                foreach($data as $ep=>$det)
                {
                    $dash = DB::select('exec [usp_Dashboard_GetCotizacionesByUsuario] ?, ?',
                                                                [
                                                                    $det['nIdUsuario'],
                                                                    $dfecha
                                                                ]);

                    array_push($array_rpta, $dash);
                }
            }
            DB::commit();
            return response()->json($array_rpta);
        } catch (Exception $e){
            DB::rollBack();
        }
    }
}
