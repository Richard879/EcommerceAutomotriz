<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IntActividadController extends Controller
{
    public function SetIntegraActividad(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $detalles = $request->data;
            foreach($detalles as $ep=>$det)
            {
                $objProyecto = DB::select('exec [usp_Integra_SetIntegraActividad] ?, ?, ?, ?, ?, ?, ?, ?',
                                                            [   $det['nActivityCode'],
                                                                $det['nActividadTipo'],
                                                                $det['cActividadTipo'],
                                                                $det['cCardCode'],
                                                                $det['nDocEntry'],
                                                                $det['nDocNum'],
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

    public function GetIntegraActividadByItemCode(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $cItemCode      =  $request->citemcode;
        $nActividadTipo =  $request->nactividadtipo;

        $arrayActividad = DB::select('exec [usp_Integra_GetIntegraActividadByItemCode] ?, ?',
                                            [   $cItemCode,
                                                $nActividadTipo
                                            ]);

        return response()->json($arrayActividad);
    }

}
