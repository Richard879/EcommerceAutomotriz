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


    public function SetProyectoAddon(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $detalles = $request->data;

            $arrayVinExiste = [];

            foreach($detalles as $ep=>$det)
            {

                $objProyecto = DB::select('exec [usp_Proyecto_SetProyecto] ?, ?, ?',
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
    }

    public function SetIntegraProyectoAddon(Request $request)
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
}
