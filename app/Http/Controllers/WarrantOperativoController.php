<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\WarrantOperativo;

class WarrantOperativoController extends Controller
{
    public function GetWOperativo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEstadoWarrant = $request->nidestadowarrant;
        $cNroWarrant = $request->cnrowarrant;
        if($cNroWarrant == ''){
            $cNroWarrant = "";
        }
        
        $arrayWOperativo = DB::select('exec usp_WO_GetWarrantByEstado ?, ?', 
                                                                        array(  $nIdEstadoWarrant,
                                                                                $cNroWarrant
                                                                                ));

        $arrayWOperativo = $this->arrayPaginator($arrayWOperativo, $request);
        return ['arrayWOperativo'=>$arrayWOperativo];   
    }

    public function GetWOperativoDetalle(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdWarrantOperativo = $request->nidwarrantoperativo;
        $cNumeroVin = $request->cnumerovin;
        $nIdEstadoWarrant = $request->nidestadowarrant;
        
        if($cNumeroVin == ''){
            $cNumeroVin = "";
        }

        $arrayWOperativoDetalle = DB::select('exec usp_WO_GetWarrantDetalleByEstado ?, ?, ?', 
                                                                        array(  $nIdWarrantOperativo,
                                                                                $cNumeroVin,
                                                                                $nIdEstadoWarrant
                                                                                ));

        $arrayWOperativoDetalle = $this->arrayPaginator($arrayWOperativoDetalle, $request);
        return ['arrayWOperativoDetalle'=>$arrayWOperativoDetalle];   
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

    public function SetWOperativo(Request $request)
    {
        /*if (!$request->ajax()) return redirect('/');
 
        try{*/
           // DB::beginTransaction();

            $wo = DB::select('exec usp_WO_SetWOperativo ?, ?, ?, ?, ?', 
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
                DB::select('exec usp_WO_SetWOperativoDetalle ?, ?, ?, ?', 
                                                            array(wo[0].nIdWarrantOperativo,
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

    public function SetWOperativoDetalle(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        try{
            DB::beginTransaction();
        

            $detalles = $request->data;

            foreach($detalles as $ep=>$det)
            {
                DB::select('exec usp_WO_SetWOperativoDetalle ?, ?, ?, ?', 
                                                            array($request->nIdWarrantOperativo,
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
