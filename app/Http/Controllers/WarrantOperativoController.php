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
        $nIdEstadoWarrant = ($nIdEstadoWarrant == NULL) ? ($nIdEstadoWarrant = 0) : $nIdEstadoWarrant;
        $cNroWarrant = ($cNroWarrant == NULL) ? ($cNroWarrant = '') : $cNroWarrant;
                
        $arrayWOperativo = DB::select('exec [usp_WO_GetWarrantByEstado] ?, ?', 
                                                            [   $nIdEstadoWarrant,
                                                                $cNroWarrant
                                                            ]);

        $arrayWOperativo = ParametroController::arrayPaginator($arrayWOperativo, $request);
        return ['arrayWOperativo'=>$arrayWOperativo];   
    }

    public function GetWOperativoDetalle(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdWarrantOperativo = $request->nidwarrantoperativo;
        $cNumeroVin = $request->cnumerovin;
        $nIdEstadoWarrant = $request->nidestadowarrant;
        
        $nIdEstadoWarrant = ($nIdEstadoWarrant == NULL) ? ($nIdEstadoWarrant = 0) : $nIdEstadoWarrant;
        $cNumeroVin = ($cNumeroVin == NULL) ? ($cNumeroVin = '') : $cNumeroVin;

        $arrayWOperativoDetalle = DB::select('exec [usp_WO_GetWarrantDetalleByEstado] ?, ?, ?', 
                                                                    [   $nIdWarrantOperativo,
                                                                        $cNumeroVin,
                                                                        $nIdEstadoWarrant
                                                                    ]);

        $arrayWOperativoDetalle = ParametroController::arrayPaginator($arrayWOperativoDetalle, $request);
        return ['arrayWOperativoDetalle'=>$arrayWOperativoDetalle];   
    }

    public function SetWOperativo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        try{
           DB::beginTransaction();

            $wo = DB::select('exec [usp_WO_SetWOperativo] ?, ?, ?, ?, ?', 
                                                    [   $request->nIdProveedor,
                                                        $request->fTotalValor,
                                                        $request->fTotalComisionDolar,
                                                        $request->fTotalComisionSol,
                                                        Auth::user()->id
                                                    ]);                 
            $nIdWarrantOperativo =  $wo[0]->nIdWarrantOperativo;

            $detalles = $request->data;
            foreach($detalles as $ep=>$det)
            {
                DB::select('exec [usp_WO_SetWOperativoDetalle] ?, ?, ?, ?, ?, ?, ?', 
                                                    [   $nIdWarrantOperativo,
                                                        $det['nIdCompra'],
                                                        $det['fTotalCompra'],
                                                        $det['fComisionDolar'],
                                                        $det['fComisionSol'],
                                                        $det['fValorTipoCambio'],
                                                        Auth::user()->id
                                                    ]);
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

    public function SetIntegraAsientoContableWO(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $detalles = $request->data;
            foreach($detalles as $ep=>$det)
            {
                $objArticulo = DB::select('exec [usp_Integra_SetIntegraAsiento] ?, ?, ?, ?, ?',
                                                            [   $det['cProjectCode'],
                                                                $det['nJdtNum'],
                                                                $det['nNumber'],
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