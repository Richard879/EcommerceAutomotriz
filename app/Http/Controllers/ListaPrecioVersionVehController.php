<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\ListaPrecioVersionVeh;

class ListaPrecioVersionVehController extends Controller
{
    public function GetListaVh(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdProveedor = $request->nidproveedor;
        
        $arrayListaPrecioVh = DB::select('exec [usp_ListaPrecioVh_GetListaPrecio] ?, ?, ?', 
                                                            [   $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $nIdProveedor
                                                            ]);
        
        $arrayListaPrecioVh = ParametroController::arrayPaginator($arrayListaPrecioVh, $request);
        return ['arrayListaPrecioVh'=>$arrayListaPrecioVh]; 
    }

    public function GetListaVhDetalle(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdListaPrecioVersionVeh = $request->nidlistaprecioversionveh;
        $nIdMarca   = $request->nidmarca;
        $nIdModelo  = $request->nidmodelo;
        $cNombreComercial = $request->cnombrecomercial;

        
        $nIdMarca = ($nIdMarca == NULL) ? ($nIdMarca = 0) : $nIdMarca;
        $nIdModelo = ($nIdModelo == NULL) ? ($nIdModelo = 0) : $nIdModelo;
        $cNombreComercial = ($cNombreComercial == NULL) ? ($cNombreComercial = '') : $cNombreComercial;
        
        $arrayListaPrecioVhDet = DB::select('exec [usp_ListaPrecioVh_GetDetalleById] ?, ?, ?, ?', 
                                                        [   $nIdListaPrecioVersionVeh,
                                                            $nIdMarca,
                                                            $nIdModelo,
                                                            $cNombreComercial
                                                        ]);
        
        $arrayListaPrecioVhDet = ParametroController::arrayPaginator($arrayListaPrecioVhDet, $request);
        return ['arrayListaPrecioVhDet'=>$arrayListaPrecioVhDet]; 
    }

    public function SetListaVh(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        $versionvehiculo = DB::select('exec [usp_ListaPrecioVh_SetListaPrecio] ?, ?, ? ,? , ?, ?, ?',
                                                            [   $request->nIdEmpresa,
                                                                $request->nIdSucursal,
                                                                $request->nIdProveedor,
                                                                $request->nIdCronograma,
                                                                $request->nNroListaPrecio,
                                                                $request->dFechaInicio,
                                                                $request->nIdTipoLista,
                                                                Auth::user()->id
                                                            ]);
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
                DB::select('exec [usp_ListaPrecioVh_SetDetalle] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?', 
                                                            [   $request->nIdListaPrecioVersionVeh,
                                                                $det['nIdVersionVeh'],
                                                                $det['cNombreComercial'],
                                                                $det['nAnioFabricacion'],
                                                                $det['nAnioVersion'],
                                                                $det['cUnidadMedida'],
                                                                $det['cMoneda'],
                                                                $det['fPrecioBase'],
                                                                $det['fDescuento'],
                                                                $det['fPrecioCierre'],
                                                                $det['fPlaca'],
                                                                $det['fMargen'],
                                                                $det['fCostoDealer'],
                                                                $det['fBono'],
                                                                $det['fPrecioCierre2'],
                                                                $det['fFlete'],
                                                                $det['fTYP'],
                                                                $det['fPrecioVentaP'],
                                                                $det['fPrecioBonoDealer'],   
                                                                $det['fBonoEspecial'],
                                                                Auth::user()->id
                                                            ]);
            }    
            DB::commit(); 
        } catch (Exception $e){
            DB::rollBack();
        }     
    }

    public function desactivar (Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $listapreciovh = DB::select('exec [usp_ListaPrecioVh_DesactivaById] ?, ?', 
                                                [  $request->nIdListaPrecioVersionVeh,
                                                    Auth::user()->id
                                                ]);
        return response()->json($listapreciovh);   
    }

    public function activar (Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $listapreciovh = DB::select('exec [usp_ListaPrecioVh_ActivaById] ?, ?, ?, ?', 
                                                    [   $request->nIdListaPrecioVersionVeh,
                                                        $request->nIdProveedor,
                                                        $request->nIdTipoLista,
                                                        Auth::user()->id
                                                    ]);
        return response()->json($listapreciovh);   
    }
}
