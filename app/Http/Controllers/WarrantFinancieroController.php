<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Warrantfinanciero;

class WarrantFinancieroController extends Controller
{
    public function GetWFinanciero(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEstadoWarrant = $request->nidestadowarrant;
        $cNroWarrant = $request->cnrowarrant;
        if($cNroWarrant == ''){
            $cNroWarrant = "";
        }

        $arrayWFinanciero = DB::select('exec usp_WF_GetWarrantByEstado ?, ?',
                                                                        array(  $nIdEstadoWarrant,
                                                                                $cNroWarrant
                                                                                ));

        $arrayWFinanciero = ParametroController::arrayPaginator($arrayWFinanciero, $request);
        return ['arrayWFinanciero'=>$arrayWFinanciero];
    }

    public function GetWFinancieroDetalle(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdWarrantFinanciero = $request->nidwarrantfinanciero;
        $cNumeroVin = $request->cnumerovin;
        $nIdEstadoWarrant = $request->nidestadowarrant;

        if($cNumeroVin == ''){
            $cNumeroVin = "";
        }

        $arrayWFinancieroDetalle = DB::select('exec usp_WF_GetWarrantDetalleByEstado ?, ?, ?',
                                                                        array(  $nIdWarrantFinanciero,
                                                                                $cNumeroVin,
                                                                                $nIdEstadoWarrant
                                                                                ));

        $arrayWFinancieroDetalle = ParametroController::arrayPaginator($arrayWFinancieroDetalle, $request);
        return ['arrayWFinancieroDetalle'=>$arrayWFinancieroDetalle];
    }

    public function SetWFinanciero(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $wo = DB::select('exec [usp_WF_SetWFinanciero] ?, ?, ?, ?',
                                                [   $request->nIdBanco,
                                                    $request->cNumeroWarrant,
                                                    $request->fTotalValor,
                                                    Auth::user()->id
                                                ]);

            $nIdWarrantFinanciero =  $wo[0]->nIdWarrantFinanciero;


            $detalles = $request->data;

            foreach($detalles as $ep=>$det)
            {
                DB::select('exec [usp_WF_SetWFinancieroDetalle] ?, ?, ?, ?',
                                                [   $nIdWarrantFinanciero,
                                                    $det['nIdCompra'],
                                                    $det['fTotalCompra'],
                                                    Auth::user()->id
                                                ]);
            }
            DB::commit();
            return $nIdWarrantFinanciero;
        }catch (Exception $e){
            DB::rollBack();
        }
    }

    public function SetWFinancieroDetalle(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();


            $detalles = $request->data;

            foreach($detalles as $ep=>$det)
            {
                DB::select('exec usp_WF_SetWFinancieroDetalle ?, ?, ?, ?',
                                                            array($request->nIdWarrantFinanciero,
                                                                $det['nIdCompra'],
                                                                $det['fTotalCompra'],
                                                                Auth::user()->id
                                                            ));
            }
            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function SetIntegraAsientoContableWF(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $detalles = $request->data;
            foreach($detalles as $ep=>$det)
            {
                $objArticulo = DB::select('exec [usp_Integra_SetIntegraAsientoWarrant] ?, ?, ?, ?, ?, ?',
                                                            [   $det['cProjectCode'],
                                                                $det['nJdtNum'],
                                                                $det['nNumber'],
                                                                $det['cTipo'],
                                                                $det['cLogRespuesta'],
                                                                Auth::user()->id
                                                            ]);
            }
            DB::commit();
            return response()->json($objArticulo);
        } catch (Exception $e){
            DB::rollBack();
        }
    }
}
