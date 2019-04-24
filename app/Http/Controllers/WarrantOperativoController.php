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

        $nIdEstadoWarrant   =   $request->nidestadowarrant;
        $cNumeroVin        =   $request->cnumerovin;

        $nIdEstadoWarrant   =   ($nIdEstadoWarrant == NULL) ? ($nIdEstadoWarrant = 0) : $nIdEstadoWarrant;
        $cNumeroVin        =   ($cNumeroVin == NULL) ? ($cNumeroVin = '') : $cNumeroVin;

        $arrayWOperativo = DB::select('exec [usp_WO_GetWarrantByEstado] ?, ?',
                                                            [   $nIdEstadoWarrant,
                                                                $cNumeroVin
                                                            ]);

        $arrayWOperativo = ParametroController::arrayPaginator($arrayWOperativo, $request);
        return ['arrayWOperativo'=>$arrayWOperativo];
    }

    public function GetWOperativoDetalle(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdWarrantOperativo    =   $request->nidwarrantoperativo;
        $cNumeroVin             =   $request->cnumerovin;
        $nIdEstadoWarrant       =   $request->nidestadowarrant;

        $nIdEstadoWarrant       =   ($nIdEstadoWarrant == NULL) ? ($nIdEstadoWarrant = 0) : $nIdEstadoWarrant;
        $cNumeroVin             =   ($cNumeroVin == NULL) ? ($cNumeroVin = '') : $cNumeroVin;

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
                DB::select('exec [usp_WO_SetWOperativoDetalle] ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                    [   $nIdWarrantOperativo,
                                                        $det['nIdCompra'],
                                                        $det['fTotalCompra'],
                                                        $det['fComisionDolar'],
                                                        $det['fComisionSol'],
                                                        $det['fValorTipoCambio'],
                                                        $det['dFechaInicio'],
                                                        $det['dFechaFin'],
                                                        Auth::user()->id
                                                    ]);
            }
            DB::commit();
            return $nIdWarrantOperativo;
        }catch (Exception $e){
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

    public function UpdEstadoWoDetalle(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $arrayWO = DB::select('exec [usp_WO_UpdEstadoWoDetalle] ?, ?, ?, ?',
                                                [   $request->nIdDetalleWarrant,
                                                    $request->nIdEstadoWarrant,
                                                    $request->nIdCompra,
                                                    Auth::user()->id
                                                ]);
        return response()->json($arrayWO);
    }

    public function GetFechaVenceByLinea(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdCompra      =   $request->nidcompra;
        $cNumeroVin     =   $request->cnumerovin;
        $nIdLinea       =   $request->nidlinea;
        $dFechaInicio   =   $request->dfechainicio;

        $nIdCompra      =   ($nIdCompra == NULL) ? ($nIdCompra = 0) : $nIdCompra;
        $cNumeroVin     =   ($cNumeroVin == NULL) ? ($cNumeroVin = '') : $cNumeroVin;

        $arrayFechVenceWO = DB::select('exec [usp_WO_GetFechaVenceByLinea] ?, ?, ?, ?',
                                                        [   $nIdCompra,
                                                            $cNumeroVin,
                                                            $nIdLinea,
                                                            $dFechaInicio,
                                                        ]);
        return ['arrayFechVenceWO'=>$arrayFechVenceWO];
    }
}
