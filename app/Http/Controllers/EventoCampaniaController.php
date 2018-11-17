<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EventoCampaniaController extends Controller
{
    public function GetEventoCampania(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $dFechaInicio = $request->dfechainicio;
        $dFechaFin = $request->dfechafin;
        $nIdProveedor = $request->nidproveedor;
        $dFechaInicio = ($dFechaInicio == NULL) ? ($dFechaInicio = '') : $dFechaInicio;
        $dFechaFin = ($dFechaFin == NULL) ? ($dFechaFin = '') : $dFechaFin;
        
        $arrayEventoCampania = DB::select('exec [usp_EC_GetEventoCampania] ?, ?, ?, ?, ?', 
                                                            [   $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $dFechaInicio,
                                                                $dFechaFin,
                                                                $nIdProveedor
                                                            ]);
        
        $arrayEventoCampania = ParametroController::arrayPaginator($arrayEventoCampania, $request);
        return ['arrayEventoCampania'=>$arrayEventoCampania]; 
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $eventocampania = DB::select('exec [usp_EC_SetEventoCampania] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?', 
                                                                [   $request->nIdEmpresa,
                                                                    $request->nIdSucursal,
                                                                    $request->nIdProveedor,
                                                                    $request->cNombreEventoCampania,
                                                                    $request->nIdTipoEvento, 
                                                                    $request->dFechaInicio,
                                                                    $request->dFechaFin,
                                                                    $request->nIdTipoCambio,
                                                                    $request->fTipoCambio,
                                                                    $request->fMontoPresupuestoDolar,
                                                                    $request->fMontoPresupuestoSol,
                                                                    $request->cFlagDetalleEvento,
                                                                    Auth::user()->id
                                                                ]);
        return response()->json($eventocampania);                                       
    }

    public function SetDetalleEventoCampania(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        try{
            DB::beginTransaction();
        
            $detalles = $request->data;

            if($request->cFlagDetalleEvento == "LI")
            {
                foreach($detalles as $ep=>$det)
                {
                    DB::select('exec [usp_EC_SetDetalleEventoCampania] ?, ?, ?, ?, ?, ?', 
                                                                [   $request->nIdEventoCampania,
                                                                    $request->cFlagDetalleEvento,
                                                                    $det['nIdLinea'],
                                                                    0,
                                                                    0,
                                                                    Auth::user()->id
                                                                ]);
                }  
            }
            
            if($request->cFlagDetalleEvento == "MA")
            {
                foreach($detalles as $ep=>$det)
                {
                    DB::select('exec [usp_EC_SetDetalleEventoCampania] ?, ?, ?, ?, ?, ?', 
                                                                [   $request->nIdEventoCampania,
                                                                    $request->cFlagDetalleEvento,
                                                                    $det['nIdMarca'],
                                                                    0,
                                                                    0,
                                                                    Auth::user()->id
                                                                ]);
                }  
            }

            if($request->cFlagDetalleEvento == "MO")
            {
                foreach($detalles as $ep=>$det)
                {
                    DB::select('exec [usp_EC_SetDetalleEventoCampania] ?, ?, ?, ?, ?, ?', 
                                                                [   $request->nIdEventoCampania,
                                                                    $request->cFlagDetalleEvento,
                                                                    $det['nIdModelo'],
                                                                    $det['nAnioFabricacion'],
                                                                    $det['nAnioModelo'],
                                                                    Auth::user()->id
                                                                ]);
                }  
            }

            DB::commit(); 
        } catch (Exception $e){
            DB::rollBack();
        }   
    }

    public function SetEventoElementoVenta(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        try{
            DB::beginTransaction();
            $detalles = $request->data;
            foreach($detalles as $ep=>$det)
            {
                DB::select('exec [usp_EC_SetEventoElementoVenta] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?', 
                                                    [   $request->nIdEventoCampania,
                                                        $det['nIdElemento'],
                                                        $det['nCantidad'],
                                                        $det['nIdMoneda'],
                                                        $det['fElemenValorVenta'],
                                                        $det['nTotalEstimado'],
                                                        $det['fSubTotal'],
                                                        $request->nIdTipoCambio,
                                                        $request->fTipoCambio,
                                                        Auth::user()->id
                                                    ]);
            }  
            DB::commit(); 
        } catch (Exception $e){
            DB::rollBack();
        }   
    }

    public function SetDistribucionEventoByEC(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        try{
            DB::beginTransaction();
        
            $detalles = $request->data;

            foreach($detalles as $ep=>$det)
            {
                DB::select('exec [usp_EC_SetDistribucionEventoByEC] ?, ?, ?, ?, ?', 
                                                    [   $request->nIdEventoCampania,
                                                        $det['cFlagEntidad'],
                                                        $det['nIdEntidad'],
                                                        $det['fValorPorcentual'],
                                                        Auth::user()->id
                                                    ]);
            }  

            DB::commit(); 
        } catch (Exception $e){
            DB::rollBack();
        }   
    }

    public function SetDistribucionEventoByElemento(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        try{
            DB::beginTransaction();
        
            $detalles = $request->data;

            foreach($detalles as $ep=>$det)
            {
                DB::select('exec [usp_EC_SetDistribucionEventoByElemento] ?, ?, ?, ?, ?, ?', 
                                                    [   $request->nIdEventoCampania,
                                                        $det['nIdEventoElementoVenta'],
                                                        $det['cFlagEntidad'],
                                                        $det['nIdEntidad'],
                                                        $det['fValorPorcentual'],
                                                        Auth::user()->id
                                                    ]);
            }  

            DB::commit(); 
        } catch (Exception $e){
            DB::rollBack();
        }   
    }

    public function GetDistribucionByElementoVenta(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEventoCampania = $request->nideventocampania;
        $variable   = $request->opcion;
        $variable = ($variable == NULL) ? ($variable = 0) : $variable;
        
        $arrayElementoDistribucion = DB::select('exec [usp_EC_GetDistribucionByElementoVenta] ?', 
                                                            [   $nIdEventoCampania
                                                            ]);
        if($variable == "0"){
            $arrayElementoDistribucion = ParametroController::arrayPaginator($arrayElementoDistribucion, $request);
        }
        return ['arrayElementoDistribucion'=>$arrayElementoDistribucion];
    }

    public function desactivar (Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEventoCampania = DB::select('exec [usp_EC_DesactivaById] ?, ?', 
                                            [   $request->nIdEventoCampania,
                                                Auth::user()->id
                                            ]);
        return response()->json($nIdEventoCampania);   
    }

    public function activar (Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEventoCampania = DB::select('exec [usp_EC_ActivaById] ?, ?', 
                                            [   $request->nIdEventoCampania,
                                                Auth::user()->id
                                            ]);
        return response()->json($nIdEventoCampania);   
    }
}
