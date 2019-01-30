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
                $objProyecto = DB::select('exec [usp_Integra_SetIntegraLlamadaServicio] ?, ?, ?, ?, ?',
                                                            [   $det['nServiceCallID'],
                                                                $det['cItemCode'],
                                                                $det['cInternalSerialNum'],
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
