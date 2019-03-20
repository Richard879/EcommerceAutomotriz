<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IntMercanciaController extends Controller
{
    public function SetIntegraMercancia(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $detalles = $request->data;
            foreach($detalles as $ep=>$det)
            {
                $objCompra = DB::select('exec [usp_Integra_SetIntegraMercancia] ?, ?, ?, ?, ?, ?',
                                                            [   $det['cItemCode'],
                                                                $det['nDocEntry'],
                                                                $det['nDocNum'],
                                                                $det['cDocType'],
                                                                $det['cLogRespuesta'],
                                                                Auth::user()->id
                                                            ]);
            }
            DB::commit();
            return response()->json($objCompra);
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function SetIntegraMercanciaEntry(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $detalles = $request->data;
            foreach($detalles as $ep=>$det)
            {
                $objCompra = DB::select('exec [usp_Integra_SetIntegraMercanciaEntry] ?, ?, ?, ?, ?, ?, ?',
                                                            [
                                                                $det['nIdCabeceraInspec'],
                                                                $det['cItemCode'],
                                                                $det['nDocEntry'],
                                                                $det['nDocNum'],
                                                                $det['cDocType'],
                                                                $det['cLogRespuesta'],
                                                                Auth::user()->id
                                                            ]);
            }
            DB::commit();
            return response()->json($objCompra);
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function SetIntegraMercanciaExit(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $detalles = $request->data;
            foreach($detalles as $ep=>$det)
            {
                $objCompra = DB::select('exec [usp_Integra_SetIntegraMercanciaEntry] ?, ?, ?, ?, ?, ?, ?',
                                                            [   $det['nIdCabeceraInspec'],
                                                                $det['cItemCode'],
                                                                $det['nDocEntry'],
                                                                $det['nDocNum'],
                                                                $det['cDocType'],
                                                                $det['cLogRespuesta'],
                                                                Auth::user()->id
                                                            ]);
            }
            DB::commit();
            return response()->json($objCompra);
        } catch (Exception $e){
            DB::rollBack();
        }
    }
}
