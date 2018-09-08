<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
//use App\VersionVehiculo;

class EventoCampaniaController extends Controller
{
    public function GetEventoCampania(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdProveedor = $request->nidproveedor;
        
        $arrayEventoCampania = DB::select('exec usp_EC_GetEventoCampania ?, ?, ?', 
                                                            array(  $nIdEmpresa,
                                                                    $nIdSucursal,
                                                                    $nIdProveedor
                                                                    ));
        
        $arrayEventoCampania = $this->arrayPaginator($arrayEventoCampania, $request);
        return ['arrayEventoCampania'=>$arrayEventoCampania]; 
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $eventocampania = DB::select('exec usp_EC_SetEventoCampania ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?', 
                                                            array($request->nIdEmpresa,
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
                                                                    ));
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
                    DB::select('exec usp_EC_SetDetalleEventoCampania ?, ?, ?, ?, ?, ?', 
                                                                array($request->nIdEventoCampania,
                                                                    $request->cFlagDetalleEvento,
                                                                    $det['nIdLinea'],
                                                                    $request->nTotalRegistros,
                                                                    $request->fValorPresupuesto,
                                                                    Auth::user()->id
                                                                ));
                }  
            }
            
            if($request->cFlagDetalleEvento == "MA")
            {
                foreach($detalles as $ep=>$det)
                {
                    DB::select('exec usp_EC_SetDetalleEventoCampania ?, ?, ?, ?, ?, ?', 
                                                                array($request->nIdEventoCampania,
                                                                    $request->cFlagDetalleEvento,
                                                                    $det['nIdMarca'],
                                                                    $request->nTotalRegistros,
                                                                    $request->fValorPresupuesto,
                                                                    Auth::user()->id
                                                                ));
                }  
            }

            if($request->cFlagDetalleEvento == "MO")
            {
                foreach($detalles as $ep=>$det)
                {
                    DB::select('exec usp_EC_SetDetalleEventoCampania ?, ?, ?, ?, ?, ?', 
                                                                array($request->nIdEventoCampania,
                                                                    $request->cFlagDetalleEvento,
                                                                    $det['nIdModelo'],
                                                                    $request->nTotalRegistros,
                                                                    $request->fValorPresupuesto,
                                                                    Auth::user()->id
                                                                ));
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
                DB::select('exec usp_EC_SetEventoElementoVenta ?, ?, ?', 
                                                            array($request->nIdEventoCampania,
                                                                $det['nIdElemento'],
                                                                Auth::user()->id
                                                            ));
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
                DB::select('exec usp_EC_SetDistribucionEventoByEC ?, ?, ?, ?, ?', 
                                                            array($request->nIdEventoCampania,
                                                                $det['cFlagEntidad'],
                                                                $det['nIdEntidad'],
                                                                $det['fValorPorcentual'],
                                                                Auth::user()->id
                                                            ));
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
                DB::select('exec usp_EC_SetDistribucionEventoByElemento ?, ?, ?, ?', 
                                                            array($det['nIdEventoElementoVenta'],
                                                                $det['nIdEntidad'],
                                                                $det['fValorPorcentual'],
                                                                Auth::user()->id
                                                            ));
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
        
        $arrayElementoDistribucion = DB::select('exec usp_EC_GetDistribucionByElementoVenta ?', 
                                                            array(  $nIdEventoCampania
                                                                    ));
        
        $arrayElementoDistribucion = $this->arrayPaginator($arrayElementoDistribucion, $request);
        return ['arrayElementoDistribucion'=>$arrayElementoDistribucion]; 
    }
    
    public function arrayPaginator($array, $request)
    {
        $page = $request->page;
        $perPage = 10;
        $offset = ($page * $perPage) - $perPage;

        /*return new LengthAwarePaginator(array_slice($array, $offset, $perPage, true), count($array), $perPage, $page,
            ['path' => $request->url(), 'query' => $request->query()]);*/

        $array = new Collection($array);
        $result = $array->forPage($page, $perPage)->values()->all();
        return  new LengthAwarePaginator($result, $array->count(), $perPage,$page);
    }

    public function desactivar (Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEventoCampania = DB::select('exec usp_EC_DesactivaById ?', 
                                                            array(  $request->nIdEventoCampania
                                                                    ));
        return response()->json($nIdEventoCampania);   
    }

    public function activar (Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEventoCampania = DB::select('exec usp_EC_ActivaById ?', 
                                                            array(  $request->nIdEventoCampania
                                                                    ));
        return response()->json($nIdEventoCampania);   
    }
}
