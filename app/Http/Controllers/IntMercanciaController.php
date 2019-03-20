<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IntMercanciaController extends Controller
{
    public function SetIntegraMercanciaCompra(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $detalles = $request->data;
            foreach($detalles as $ep=>$det)
            {
                $objCompra = DB::select('exec [usp_Integra_SetIntegraMercanciaCompra] ?, ?, ?, ?, ?, ?',
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

    public function SetIntegraMercancia(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $detalles = $request->data;
            foreach($detalles as $ep=>$det)
            {
                $objCompra = DB::select('exec [usp_Integra_SetIntegraMercancia] ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                            [
                                                                $det['nTipo'],
                                                                $det['cTipoDescripcion'],
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
}
