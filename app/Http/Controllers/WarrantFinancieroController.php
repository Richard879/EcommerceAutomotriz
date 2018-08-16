<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
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

        $arrayWFinanciero = $this->arrayPaginator($arrayWFinanciero, $request);
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

        $arrayWFinancieroDetalle = $this->arrayPaginator($arrayWFinancieroDetalle, $request);
        return ['arrayWFinancieroDetalle'=>$arrayWFinancieroDetalle];   
    }

    public function arrayPaginator($array, $request)
    {
        $page = $request->page;
        $perPage = 10;
        $offset = ($page * $perPage) - $perPage;

        $array = new Collection($array);
        $result = $array->forPage($page, $perPage)->values()->all();
        return  new LengthAwarePaginator($result, $array->count(), $perPage,$page);
    }

    public function SetWFinanciero(Request $request)
    {
        /*if (!$request->ajax()) return redirect('/');
 
        try{*/
           // DB::beginTransaction();

            $wo = DB::select('exec usp_WF_SetWFinanciero ?, ?, ?, ?, ?', 
                                                            array($request->nIdBanco,
                                                                $request->cNumeroWarrant,
                                                                $request->dFechaInicio,
                                                                $request->dFechaVence,
                                                                Auth::user()->id
                                                            ));
                                   
            return response()->json($wo);
            

            /*$detalles = $request->data;

            foreach($detalles as $ep=>$det)
            {
                DB::select('exec usp_WF_SetWFinancieroDetalle ?, ?, ?, ?', 
                                                            array(wo[0].nIdWarrantFinanciero,
                                                                $det['nIdCompra'],
                                                                $det['fValorWarrant'],
                                                                Auth::user()->id
                                                            ));
            }  */
           // DB::commit(); 
        /*} catch (Exception $e){
            DB::rollBack();
        }  */   
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
}
