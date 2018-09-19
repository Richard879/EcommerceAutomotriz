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
        $nIdProveedor = $request->nidproveedor;
        
        $arrayEventoCampania = DB::select('exec [usp_EC_GetEventoCampania] ?, ?, ?', 
                                                            [   $nIdEmpresa,
                                                                $nIdSucursal,
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
                                                                    $request->fValorPresupuesto,
                                                                    $request->nIdMoneda,
                                                                    $request->nIdTipoCambio,
                                                                    $request->fValorTipoCambio,
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
                                                                    $request->nTotalRegistros,
                                                                    $request->fValorPresupuesto,
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
                                                                    $request->nTotalRegistros,
                                                                    $request->fValorPresupuesto,
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
                                                                    $request->nTotalRegistros,
                                                                    $request->fValorPresupuesto,
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
                DB::select('exec [usp_EC_SetEventoElementoVenta] ?, ?, ?', 
                                                    [   $request->nIdEventoCampania,
                                                        $det['nIdElemento'],
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
                DB::select('exec [usp_EC_SetDistribucionEventoByElemento] ?, ?, ?, ?', 
                                                    [   $det['nIdEventoElementoVenta'],
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
        
        $arrayElementoDistribucion = DB::select('exec [usp_EC_GetDistribucionByElementoVenta] ?', 
                                                            [   $nIdEventoCampania
                                                            ]);
        
        $arrayElementoDistribucion = $this->arrayPaginator($arrayElementoDistribucion, $request);
        return ['arrayElementoDistribucion'=>$arrayElementoDistribucion]; 
    }

    public function desactivar (Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEventoCampania = DB::select('exec [usp_EC_DesactivaById] ?', 
                                            [   $request->nIdEventoCampania
                                            ]);
        return response()->json($nIdEventoCampania);   
    }

    public function activar (Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEventoCampania = DB::select('exec [usp_EC_ActivaById] ?', 
                                            [   $request->nIdEventoCampania
                                            ]);
        return response()->json($nIdEventoCampania);   
    }
}
