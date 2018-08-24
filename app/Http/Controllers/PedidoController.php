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
}
