<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
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

    public function GetLstCotizacionIngresadas(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $dFechaInicio = $request->dfechainicio;
        $dFechaFin = $request->dfechafin;
        $nIdMarca = $request->nidmarca;
        $nIdModelo = $request->nidmodelo;

        $arrayPedido = DB::select('exec usp_Pedido_GetLstCotizacionIngresadas ?, ?, ?, ?, ?, ?, ?',
                                                            array(  $nIdEmpresa,
                                                                    $nIdSucursal,
                                                                    $dFechaInicio,
                                                                    $dFechaFin,
                                                                    $nIdMarca,
                                                                    $nIdModelo,
                                                                    Auth::user()->id
                                                                    ));

        $arrayPedido = $this->arrayPaginator($arrayPedido, $request);
        return ['arrayPedido'=>$arrayPedido];
    }

    public function GetLstCompraByIdModelo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdCabeceraCotizacion = $request->nidcabeceracotizacion;
        $cNumeroVin = $request->cnumerovin;

        $cNumeroVin = ($cNumeroVin == NULL) ? ($cNumeroVin = ' ') : $cNumeroVin;

        $arrayCompra = DB::select('exec usp_Pedido_GetLstCompraByIdModelo ?, ?, ?, ?',
                                                            array(  $nIdEmpresa,
                                                                    $nIdSucursal,
                                                                    $nIdCabeceraCotizacion,
                                                                    $cNumeroVin
                                                                    ));

        $arrayCompra = $this->arrayPaginator($arrayCompra, $request);
        return ['arrayCompra'=>$arrayCompra];
    }

    public function GetListaPrecioDetalleByIdCotizacion(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdCabeceraCotizacion = $request->nidcabeceracotizacion;

        $objListaDetalle = DB::select('exec usp_Pedido_GetListaPrecioDetalleByIdCotizacion ?, ?, ?',
                                                                            array(  $nIdEmpresa,
                                                                                    $nIdSucursal,
                                                                                    $nIdCabeceraCotizacion
                                                                                    ));
        return response()->json($objListaDetalle);
    }

    public function GetLstPedidos(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nidempresa    =   $request->nidempresa;
        $nidsucursal   =   $request->nidsucursal;
        $nidlinea      =   $request->nidlinea;
        $nidmarca      =   $request->nidmarca;
        $nidmodelo     =   $request->nidmodelo;
        $dfechainicio  =   $request->dfechainicio;
        $dfechafin     =   $request->dfechafin;

        $nidlinea = ($nidlinea == NULL) ? ($nidlinea = '') : $nidlinea;
        $nidmarca = ($nidmarca == NULL) ? ($nidmarca = '') : $nidmarca;
        $nidmodelo = ($nidmodelo == NULL) ? ($nidmodelo = '') : $nidmodelo;
        $dfechainicio = ($dfechainicio == NULL) ? ($dfechainicio = '') : $dfechainicio;
        $dfechafin = ($dfechafin == NULL) ? ($dfechafin = '') : $dfechafin;

        $arrayPedido = DB::select('exec usp_Pedido_GetLstPedidosIngresadas ?, ?, ?, ?, ?, ?, ?, ?',
                                    [
                                        $nidempresa, $nidsucursal, $nidlinea,
                                        $nidmarca, $nidmodelo, $dfechainicio,
                                        $dfechafin, Auth::user()->id
                                    ]);

        $arrayPedido = $this->arrayPaginator($arrayPedido, $request);
        return ['arrayPedido'=>$arrayPedido];
    }

    public function aprobarPedido(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nidpedido  =  $request->nidpedido;

        $arrayPedido = DB::select('exec usp_Pedido_SetAprobarPedido ?', [$nidpedido]);
        return response()->json($arrayPedido);
    }

}
