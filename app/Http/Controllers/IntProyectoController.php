<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IntProyectoController extends Controller
{
    public function SetIntegraProyecto(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $detalles = $request->data;
            foreach($detalles as $ep=>$det)
            {
                $objProyecto = DB::select('exec [usp_Integra_SetIntegraProyecto] ?, ?, ?, ?',
                                                            [   $det['cCode'],
                                                                $det['cName'],
                                                                $det['cLogRespuesta'],
                                                                Auth::user()->id
                                                            ]);
            }
            DB::commit();
            return response()->json($objProyecto);
        } catch (Exception $e){
            DB::rollBack();
        }
    }


    /*public function AddonSetProyecto(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $detalles = $request->data;

            $arrayVinExiste = [];

            foreach($detalles as $ep=>$det)
            {

                $objProyecto = DB::select('exec [usp_Addon_SetProyectoAddon] ?, ?, ?',
                                                            [   $request->nIdEmpresa,
                                                                $det['cNumeroVin'],
                                                                Auth::user()->id
                                                            ]);
                if($objProyecto[0]->nFlagMsje == 0){
                    array_push($arrayVinExiste,$objProyecto[0]->cNumeroVin);
                }
            }
            $data = [
                'arrayVinExiste'        =>  $arrayVinExiste
            ];
            DB::commit();
            return response()->json($data);
        } catch (Exception $e){
            DB::rollBack();
        }
    }*/

    public function AddonSetProyecto(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $detalles = $request->data;

            foreach($detalles as $ep=>$det)
            {

                $objProyecto = DB::select('exec [usp_Migracion_CarteraClientes] ?, ?, ?',
                                                            [   $request->nIdEmpresa,
                                                                $det['cNumeroVin'],
                                                                Auth::user()->id
                                                            ]);
            }
            DB::commit();
            return response()->json($data);
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function AddonIntegraSetProyecto(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $detalles = $request->data;
            foreach($detalles as $ep=>$det)
            {
                $objProyecto = DB::select('exec [usp_AddonIntegra_SetIntegraProyectoAddon] ?, ?, ?, ?',
                                                            [   $det['cCode'],
                                                                $det['cName'],
                                                                $det['cLogRespuesta'],
                                                                Auth::user()->id
                                                            ]);
            }
            DB::commit();
            return response()->json($objProyecto);
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function AddonGetProyecto(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa     = $request->nidempresa;
        $dFechaInicio   = $request->dfechainicio;
        $dFechaFin      = $request->dfechafin;
        $cNumeroVin     = $request->cnumerovin;

        $dFechaInicio   = ($dFechaInicio == NULL) ? ($dFechaInicio = '') : $dFechaInicio;
        $dFechaFin      = ($dFechaFin == NULL) ? ($dFechaFin = '') : $dFechaFin;
        $cNumeroVin     = ($cNumeroVin == NULL) ? ($cNumeroVin = '') : $cNumeroVin;

        $arrayAddonProyecto = DB::select('exec [usp_Addon_GetProyectoAddon] ?, ?, ?, ?',
                                                            [   $nIdEmpresa,
                                                                $dFechaInicio,
                                                                $dFechaFin,
                                                                $cNumeroVin
                                                            ]);
        return ['arrayAddonProyecto'=>$arrayAddonProyecto];
    }
}
