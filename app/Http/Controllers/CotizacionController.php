<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CotizacionController extends Controller
{
    public function arrayPaginator($array, $request)
    {
        $page = $request->page;
        $perPage = 10;
        $offset = ($page * $perPage) - $perPage;

        $array = new Collection($array);
        $result = $array->forPage($page, $perPage)->values()->all();
        return  new LengthAwarePaginator($result, $array->count(), $perPage,$page);
    }

    public function GetTipoLista(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nidproveedor = $request->nidproveedor;
        $tipoLista = $request->nidtipolista;

        $arrayTipoLista = DB::select('exec usp_Cotizacion_GetListTipoLista ?, ?', [$nidproveedor, $tipoLista]);

        return response()->json($arrayTipoLista);
    }

    public function GetListVehiculos(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nidproveedor = $request->nidproveedor;
        $nidtipolista = $request->nidtipolista;
        $nidlinea   = $request->nidlinea;
        $nidmarca   = $request->nidmarca;
        $nidmodelo  = $request->nidmodelo;
        $cnombrecomercial = $request->cnombrecomercial;

        $cnombrecomercial = ($cnombrecomercial == "") ? ($cnombrecomercial = '') : $cnombrecomercial;

        $arrayListaVehiculos = DB::select('exec usp_Cotizacion_GetListVehiculos ?, ?, ?, ?, ?',
                                                                        [
                                                                            $nidproveedor,
                                                                            $nidtipolista,
                                                                            $nidlinea,
                                                                            $nidmarca,
                                                                            $nidmodelo,
                                                                            $cnombrecomercial
                                                                        ]);

        $arrayListaVehiculos = $this->arrayPaginator($arrayListaVehiculos, $request);
        return ['arrayListaVehiculos'=>$arrayListaVehiculos];
    }

    public function GetTipoCambio(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $tipocambio = DB::select('exec usp_Cotizacion_GetTipoCambio');
        return response()->json($tipocambio);
    }

    public function SetCabeceraCotizacion(Request $request)
    {
        // return $request;

        if (!$request->ajax()) return redirect('/');

        $arrayCabeceraCotizacion = DB::select('exec usp_Cotizacion_SetCabeceraCotizacion ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                    array(  $request->nIdAsignacionContactoVendedor,
                                            $request->cNumeroCotizacion,
                                            $request->nIdEmpresa,
                                            $request->nIdSucursal,
                                            $request->nIdReferencia,
                                            $request->dFechaCotizacion,
                                            $request->dFechaVencimientoCotizacion,
                                            $request->fTipoCambioVenta,
                                            $request->fTipoCambioCompra,
                                            $request->fTotalCotizacionVehiculoDolar,
                                            $request->fTotalCotizacionVehiculoSol,
                                            $request->fTotalElementoVentaDolar,
                                            $request->fTotalElementoVentaSol,
                                            Auth::user()->id
                                        ));

        return response()->json($arrayCabeceraCotizacion);
    }

    public function SetDetalleCotizacion(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $arrayvehiculos = $request->arrayvehiculos;
            //Itera todas las referencias de vehiculos
            foreach($arrayvehiculos as $ep=>$det)
            {
                DB::select('exec usp_Cotizacion_SetDetalleCotizacion
                                ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                            [
                                                $request->nIdCabeCoti,
                                                $det['flagTipoItem'],
                                                $det['codigo'],
                                                null,
                                                null,
                                                'N',
                                                null,
                                                'N',
                                                $det['nidmoneda'],
                                                $det['cantidad'],
                                                $det['preciofinal'],
                                                $det['dscto'],
                                                $det['subtotal'],
                                                Auth::user()->id
                                            ]);
            }

            $arrayelemventa = $request->arrayelemventa;
            //Itera todas las referencias de vehiculos
            foreach($arrayelemventa as $ep=>$det)
            {
                DB::select('exec usp_Cotizacion_SetDetalleCotizacion
                                ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                            [
                                                $request->nIdCabeCoti,
                                                $det['flagTipoItem'],
                                                null,
                                                null,
                                                $det['codigo'],
                                                'N',
                                                null,
                                                'N',
                                                $det['nidmoneda'],
                                                $det['cantidad'],
                                                $det['preciofinal'],
                                                $det['dscto'],
                                                $det['subtotal'],
                                                Auth::user()->id
                                            ]);
            }
            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }
}
