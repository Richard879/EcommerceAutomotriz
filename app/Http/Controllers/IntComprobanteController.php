<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IntComprobanteController extends Controller
{
    public function SetIntegraComprobante(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $detalles = $request->data;
            foreach($detalles as $ep=>$det)
            {
                $objFactura = DB::select('exec [usp_Integra_SetIntegraComprobante] ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                            [   $det['cFlagTipo'],
                                                                $det['cItemCode'],
                                                                $det['cTipoComprobante'],
                                                                $det['nDocEntry'],
                                                                $det['nDocNum'],
                                                                $det['cDocType'],
                                                                $det['cLogRespuesta'],
                                                                Auth::user()->id
                                                            ]);
            }
            DB::commit();
            return response()->json($objFactura);
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function SetIntegraComprobanteFR(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $objFactura = DB::select('exec [usp_Integra_SetIntegraComprobanteFR] ?, ?, ?, ?, ?, ?',
                                                        [   $request->cFlagTipo,
                                                            $request->cItemCode,
                                                            $request->cTipoComprobante,
                                                            $request->nDocNum,
                                                            $request->cDocType,
                                                            Auth::user()->id
                                                        ]);
            DB::commit();
            return response()->json($objFactura);
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function SetIntegraComprobanteWarrant(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $detalles = $request->data;
            foreach($detalles as $ep=>$det)
            {
                $objFactura = DB::select('exec [usp_Integra_SetIntegraComprobanteWarrant] ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                            [   $det['cFlagTipo'],
                                                                $det['cItemCode'],
                                                                $det['cTipoComprobante'],
                                                                $det['nDocEntry'],
                                                                $det['nDocNum'],
                                                                $det['cDocType'],
                                                                $det['fDocRate'],
                                                                $det['cLogRespuesta'],
                                                                Auth::user()->id
                                                            ]);
            }
            DB::commit();
            return response()->json($objFactura);
        } catch (Exception $e){
            DB::rollBack();
        }
    }
}
