<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\ListaPrecioVersionVeh;

class ListaPrecioVersionVehController extends Controller
{
    public function GetListaVh(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdProveedor = $request->nidproveedor;
        
        $arrayListaPrecioVh = DB::select('exec usp_ListaPrecioVh_GetListaPrecio ?, ?, ?', 
                                                            array(  $nIdEmpresa,
                                                                    $nIdSucursal,
                                                                    $nIdProveedor
                                                                    ));
        
        $arrayListaPrecioVh = $this->arrayPaginator($arrayListaPrecioVh, $request);
        return ['arrayListaPrecioVh'=>$arrayListaPrecioVh]; 
    }

    public function GetListaVhDetalle(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdListaPrecioVersionVeh = $request->nidlistaprecioversionveh;
        
        $arrayListaPrecioVhDet = DB::select('exec usp_ListaPrecioVh_GetDetalleById ?', 
                                                            array(  $nIdListaPrecioVersionVeh
                                                                    ));
        
        $arrayListaPrecioVhDet = $this->arrayPaginator($arrayListaPrecioVhDet, $request);
        return ['arrayListaPrecioVhDet'=>$arrayListaPrecioVhDet]; 
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

    public function SetListaVh(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        $versionvehiculo = DB::select('exec usp_ListaPrecioVh_SetListaPrecio ?, ?, ? ,? , ?, ?, ?',
                                                            array($request->nIdEmpresa,
                                                                    $request->nIdSucursal,
                                                                    $request->nIdProveedor,
                                                                    $request->nIdCronograma,
                                                                    $request->nNroListaPrecio,
                                                                    $request->dFechaInicio,
                                                                    $request->nIdTipoLista,
                                                                    Auth::user()->id
                                                                    ));
        return response()->json($versionvehiculo);          
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        try{
            DB::beginTransaction();

            $detalles = $request->data;

            foreach($detalles as $ep=>$det)
            {
                //
                DB::select('exec usp_ListaPrecioVh_SetDetalle ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?', 
                                                            array($request->nIdListaPrecioVersionVeh,
                                                                $det['nIdVersionVeh'],
                                                                $det['cNombreComercial'],
                                                                $det['nAnioFabricacion'],
                                                                $det['nAnioModelo'],
                                                                $det['cUnidadMedida'],
                                                                $det['fPrecioBase'],
                                                                $det['fDescuento'],
                                                                $det['fPrecioCierre'],
                                                                $det['fPlaca'],
                                                                $det['fMargen'],
                                                                $det['fCostoDealer'],
                                                                $det['fBono'],
                                                                $det['fPrecioCierre2'],
                                                                $det['fFlete'],
                                                                $det['fPrecioVentaP'],
                                                                $det['fFleteProveedor'],
                                                                $det['fPorcDsctoFp'],
                                                                $det['fFactorFc'],
                                                                $det['fDescuentoFc'],
                                                                $det['fPrecioBono'],
                                                                $det['fPrecioDealer'],   
                                                                $det['fBonoEspecial'],
                                                                Auth::user()->id
                                                            ));
            }    
            DB::commit(); 
        } catch (Exception $e){
            DB::rollBack();
        }     
    }

    public function desactivar (Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $listapreciovh = DB::select('exec usp_ListaPrecioVh_DesactivaById ?', 
                                                            array(  $request->nIdListaPrecioVersionVeh
                                                                    ));
        return response()->json($listapreciovh);   
    }

    public function activar (Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $listapreciovh = DB::select('exec usp_ListaPrecioVh_ActivaById ?, ?, ?', 
                                                            array(  $request->nIdListaPrecioVersionVeh,
                                                                    $request->nIdProveedor,
                                                                    $request->nIdTipoLista
                                                                    ));
        return response()->json($listapreciovh);   
    }
}
