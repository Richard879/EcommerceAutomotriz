<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IntLlamadaServicioController extends Controller
{
    public function SetIntegraLlamadaServicio(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $detalles = $request->data;
            foreach($detalles as $ep=>$det)
            {
                $objLlamadaServicio = DB::select('exec [usp_Integra_SetIntegraLlamadaServicio] ?, ?, ?, ?, ?, ?, ?',
                                                            [   $det['nServiceCallID'],
                                                                $det['cFlagTipo'],
                                                                $det['nActivityCode'],
                                                                $det['cItemCode'],
                                                                $det['cInternalSerialNum'],
                                                                $det['cLogRespuesta'],
                                                                Auth::user()->id
                                                            ]);
            }
            DB::commit();
            return response()->json($objLlamadaServicio);
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function SetIntegraLlamadaServicioVenta(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            // ======================================================================
            // GUARDAR LLAMADA DE SERVICIOS DE LA O.V DEL VEHICULO EN SQL SERVER
            // ======================================================================
            $arraySapUpdSgcVehiculoLength = sizeof($request->arraySapUpdSgcVehiculo);
            if($arraySapUpdSgcVehiculoLength > 0) {
                $data = $request->arraySapUpdSgcVehiculo;
                foreach($data as $ep=>$det)
                {
                    $objProyecto = DB::select('exec [usp_Integra_SetIntegraLlamadaServicio] ?, ?, ?, ?, ?, ?, ?',
                                                                [   $det['nServiceCallID'],
                                                                    $det['cFlagTipo'],
                                                                    $det['nActivityCode'],
                                                                    $det['cItemCode'],
                                                                    $det['cInternalSerialNum'],
                                                                    $det['cLogRespuesta'],
                                                                    Auth::user()->id
                                                                ]);
                }
            }

            $arrayServiceCallActivitiesLength = sizeof($request->arrayServiceCallActivities);
            if($arrayServiceCallActivitiesLength > 0) {
                $data = $request->arrayServiceCallActivities;
                foreach($data as $ep=>$det)
                {
                    $objProyecto = DB::select('exec [usp_Integra_UpdActividadByServiceCallID] ?, ?',
                                                                [   $det['nServiceCallID'],
                                                                    $det['nActivityCode']
                                                                ]);
                }
            }
            /*
                // ======================================================================
                // GUARDAR LLAMADA DE SERVICIOS DE LA O.V DEL E.V EN SQL SERVER
                // ======================================================================
                $arraySapUpdSgcEVLength = sizeof($request->arraySapUpdSgcEV);
                if($arraySapUpdSgcEVLength > 0) {
                    $data = $request->arraySapUpdSgcEV;
                    foreach($data as $ep=>$det)
                    {
                        $objProyecto = DB::select('exec [usp_Integra_SetIntegraLlamadaServicio] ?, ?, ?, ?, ?, ?',
                                                                    [   $det['nServiceCallID'],
                                                                        $det['nActivityCode'],
                                                                        $det['cItemCode'],
                                                                        $det['cInternalSerialNum'],
                                                                        $det['cLogRespuesta'],
                                                                        Auth::user()->id
                                                                    ]);
                    }
                }
            */

            DB::commit();
            return response()->json($objProyecto);
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function SetIntegraSolucion(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $detalles = $request->data;
            foreach($detalles as $ep=>$det)
            {
                $objSolucion = DB::select('exec [usp_Integra_SetIntegraSolucion] ?, ?, ?, ?, ?',
                                                            [   $det['nSolutionCode'],
                                                                $det['cItemCode'],
                                                                $det['cFlagTipo'],
                                                                $det['cLogRespuesta'],
                                                                Auth::user()->id
                                                            ]);
            }
            DB::commit();
            return response()->json($objSolucion);
        } catch (Exception $e){
            DB::rollBack();
        }
    }

}
