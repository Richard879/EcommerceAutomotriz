<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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

        $arrayWOperativo = ParametroController::arrayPaginator($arrayWOperativo, $request);
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

        $arrayWOperativoDetalle = ParametroController::arrayPaginator($arrayWOperativoDetalle, $request);
        return ['arrayWOperativoDetalle'=>$arrayWOperativoDetalle];   
    }

    public function SetWOperativo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        try{
           DB::beginTransaction();

            $wo = DB::select('exec usp_WO_SetWOperativo ?, ?, ?, ?, ?', 
                                                            array($request->nIdBanco,
                                                                $request->cNumeroWarrant,
                                                                $request->dFechaInicio,
                                                                $request->dFechaVence,
                                                                Auth::user()->id
                                                            ));                                                 
            $nIdWarrantOperativo =  $wo[0]->nIdWarrantOperativo;

            $detalles = $request->data;
            foreach($detalles as $ep=>$det)
            {
                DB::select('exec usp_WO_SetWOperativoDetalle ?, ?, ?, ?', 
                                                            array($nIdWarrantOperativo,
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
