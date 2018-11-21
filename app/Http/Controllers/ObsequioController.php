<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ObsequioController extends Controller
{
    public function GetObsequio(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $dFechaInicio = $request->dfechainicio;
        $dFechaFin = $request->dfechafin;
        $nIdProveedor = $request->nidproveedor;
        $dFechaInicio = ($dFechaInicio == NULL) ? ($dFechaInicio = '') : $dFechaInicio;
        $dFechaFin = ($dFechaFin == NULL) ? ($dFechaFin = '') : $dFechaFin;
        
        $arrayObsequio = DB::select('exec [usp_Obsequio_GetObsequio] ?, ?, ?, ?, ?', 
                                                            [   $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $dFechaInicio,
                                                                $dFechaFin,
                                                                $nIdProveedor
                                                            ]);
        
        $arrayObsequio = ParametroController::arrayPaginator($arrayObsequio, $request);
        return ['arrayObsequio'=>$arrayObsequio]; 
    }

    public function SetObsequio(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $eventocampania = DB::select('exec [usp_Obsequio_SetObsequio] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?', 
                                                                [   $request->nIdEmpresa,
                                                                    $request->nIdSucursal,
                                                                    $request->nIdProveedor,
                                                                    $request->cNombreObsequio,
                                                                    $request->dFechaInicio,
                                                                    $request->dFechaFin,
                                                                    $request->nIdTipoCambio,
                                                                    $request->fTipoCambio,
                                                                    $request->fMontoPresupuestoDolar,
                                                                    $request->fMontoPresupuestoSol,
                                                                    $request->cFlagDetalleObsequio,
                                                                    Auth::user()->id
                                                                ]);
        return response()->json($eventocampania);                                       
    }

    public function SetDetalleObsequio(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        try{
            DB::beginTransaction();
        
            $detalles = $request->data;

            if($request->cFlagDetalleObsequio == "LI")
            {
                foreach($detalles as $ep=>$det)
                {
                    DB::select('exec [usp_Obsequio_SetDetalleObsequio] ?, ?, ?, ?, ?, ?', 
                                                                [   $request->nIdObsequio,
                                                                    $request->cFlagDetalleObsequio,
                                                                    $det['nIdLinea'],
                                                                    0,
                                                                    0,
                                                                    Auth::user()->id
                                                                ]);
                }  
            }
            
            if($request->cFlagDetalleObsequio == "MA")
            {
                foreach($detalles as $ep=>$det)
                {
                    DB::select('exec [usp_Obsequio_SetDetalleObsequio] ?, ?, ?, ?, ?, ?', 
                                                                [   $request->nIdObsequio,
                                                                    $request->cFlagDetalleObsequio,
                                                                    $det['nIdMarca'],
                                                                    0,
                                                                    0,
                                                                    Auth::user()->id
                                                                ]);
                }  
            }

            if($request->cFlagDetalleObsequio == "MO")
            {
                foreach($detalles as $ep=>$det)
                {
                    DB::select('exec [usp_Obsequio_SetDetalleObsequio] ?, ?, ?, ?, ?, ?', 
                                                                [   $request->nIdObsequio,
                                                                    $request->cFlagDetalleObsequio,
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

    public function SetObsequioElementoVenta(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        try{
            DB::beginTransaction();
            $detalles = $request->data;
            foreach($detalles as $ep=>$det)
            {
                DB::select('exec [usp_Obsequio_SetObsequioElementoVenta] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?', 
                                                    [   $request->nIdObsequio,
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

    public function SetDistribucionObsequioByObsequio(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        try{
            DB::beginTransaction();
        
            $detalles = $request->data;

            foreach($detalles as $ep=>$det)
            {
                DB::select('exec [usp_Obsequio_SetDistribucionObsequioByObsequio] ?, ?, ?, ?, ?', 
                                                    [   $request->nIdObsequio,
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

    public function SetDistribucionObsequioByElemento(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        try{
            DB::beginTransaction();
        
            $detalles = $request->data;

            foreach($detalles as $ep=>$det)
            {
                DB::select('exec [usp_Obsequio_SetDistribucionObsequioByElemento] ?, ?, ?, ?, ?, ?', 
                                                    [   $request->nIdObsequio,
                                                        $det['nIdObsequioElementoVenta'],
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

        $nIdObsequio = $request->nideventocampania;
        $variable   = $request->opcion;
        $variable = ($variable == NULL) ? ($variable = 0) : $variable;
        
        $arrayElementoDistribucion = DB::select('exec [usp_Obsequio_GetDistribucionByElementoVenta] ?', 
                                                            [   $nIdObsequio
                                                            ]);
        if($variable == "0"){
            $arrayElementoDistribucion = ParametroController::arrayPaginator($arrayElementoDistribucion, $request);
        }
        return ['arrayElementoDistribucion'=>$arrayElementoDistribucion];
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdObsequio = DB::select('exec [usp_Obsequio_DesactivaById] ?, ?', 
                                            [   $request->nIdObsequio,
                                                Auth::user()->id
                                            ]);
        return response()->json($nIdObsequio);   
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdObsequio = DB::select('exec [usp_Obsequio_ActivaById] ?, ?', 
                                            [   $request->nIdObsequio,
                                                Auth::user()->id
                                            ]);
        return response()->json($nIdObsequio);   
    }

    public function SetEntregaObsequioElementoVenta(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        try{
            DB::beginTransaction();
        
            $detalles = $request->data;

            foreach($detalles as $ep=>$det)
            {
                DB::select('exec [usp_Obsequio_SetEntregaByObsequioElementoVenta] ?, ?, ?, ?, ?', 
                                                    [   $request->nIdObsequio,
                                                        $det['nIdObsequioElementoVenta'],
                                                        $det['nIdModalidad'],
                                                        $det['nCantidad'],
                                                        Auth::user()->id
                                                    ]);
            }  

            DB::commit(); 
        } catch (Exception $e){
            DB::rollBack();
        }
    }
}
