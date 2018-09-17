<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CotizacionController extends Controller
{
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

        $arrayListaVehiculos = DB::select('exec usp_Cotizacion_GetListVehiculos ?, ?, ?, ?, ?, ?',
                                                                        [
                                                                            $nidproveedor,
                                                                            $nidtipolista,
                                                                            $nidlinea,
                                                                            $nidmarca,
                                                                            $nidmodelo,
                                                                            $cnombrecomercial
                                                                        ]);
        
        $arrayListaVehiculos = ParametroController::arrayPaginator($arrayListaVehiculos, $request);
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
        if (!$request->ajax()) return redirect('/');

        $arrayCabeceraCotizacion = DB::select('exec usp_Cotizacion_SetCabeceraCotizacion ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                    array(
                                        $request->nIdAsignacionContactoVendedor,
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
                DB::select('exec usp_Cotizacion_SetDetalleCotizacion ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                            [
                                                $request->nIdCabeCoti,
                                                $det['flagTipoItem'],
                                                $det['codigo'],
                                                0,
                                                0,
                                                'N',
                                                0,
                                                'N',
                                                $det['nidmoneda'],
                                                $det['cantidad'],
                                                $det['preciofinal'],
                                                $det['dscto'],
                                                $det['subtotal'],
                                                Auth::user()->id
                                            ]);
            }

            $arrayelemventalength = sizeof($request->arrayelemventa);
            if($arrayelemventalength > 0){
                $arrayelemventa = $request->arrayelemventa;
                //Itera todas las referencias de vehiculos
                foreach($arrayelemventa as $ep=>$det)
                {
                    DB::select('exec usp_Cotizacion_SetDetalleCotizacion ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                [
                                                    $request->nIdCabeCoti,
                                                    $det['flagTipoItem'],
                                                    0,
                                                    0,
                                                    $det['codigo'],
                                                    'N',
                                                    0,
                                                    'N',
                                                    $det['nidmoneda'],
                                                    $det['cantidad'],
                                                    $det['preciofinal'],
                                                    $det['dscto'],
                                                    $det['subtotal'],
                                                    Auth::user()->id
                                                ]);
                }
            }

            $arrayeventoelemventalength = sizeof($request->arrayeventoeleventa);
            if($arrayeventoelemventalength > 0){
                $arrayeventoeleventa = $request->arrayeventoeleventa;
                //Itera todas las referencias de vehiculos
                foreach($arrayeventoeleventa as $ep=>$det)
                {
                    DB::select('exec usp_Cotizacion_SetDetalleCotizacion ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                [
                                                    $request->nIdCabeCoti,
                                                    $det['flagTipoItem'],
                                                    0,
                                                    0,
                                                    $det['codigoEV'],
                                                    'S',
                                                    $det['codigoEEV'],
                                                    'N',
                                                    $det['nidmoneda'],
                                                    $det['cantidad'],
                                                    $det['preciofinal'],
                                                    $det['dscto'],
                                                    $det['preciofinal'],
                                                    Auth::user()->id
                                                ]);
                }
            }
            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function GetListCampañasByVehiculo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nidproveedor   = $request->nidproveedor;
        $fecha          = $request->fecha;
        $nidcodigo      = $request->nidcodigo;
        $tipo           = $request->tipo;

        $arrayEventoCampania = DB::select('exec usp_Cotizacion_GetListCampañasByVehiculo ?, ?, ?, ?',
                                                                        [
                                                                            $nidproveedor,
                                                                            $fecha,
                                                                            $nidcodigo,
                                                                            $tipo
                                                                        ]);

        return response()->json($arrayEventoCampania);
    }

    public function GetListEventoElementoVenta(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $fecha              = $request->fecha;
        $nideventocampania  = $request->nideventocampania;

        $arrayEventoEleVenta = DB::select('exec usp_Cotizacion_GetListEventoElementoVenta ?, ?',
                                                                        [
                                                                            $fecha,
                                                                            $nideventocampania
                                                                        ]);

        return response()->json($arrayEventoEleVenta);
    }

    public function GetListCotizacionesByIdVendedor(Request $request)
    {
        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $dFechaInicio = $request->dfechainicio;
        $dFechaFin = $request->dfechafin;
        $nIdMarca = $request->nidmarca;
        $nIdModelo = $request->nidmodelo;
        $nIdEstadoCotizacion = $request->nidestadocotizacion;

        $arrayCotizaciones = DB::select('exec usp_Cotizacion_GetListCotizacionesByIdVendedor ?, ?, ?, ?, ?, ?, ?, ?',
                                                            array(  $nIdEmpresa,
                                                                    $nIdSucursal,
                                                                    $dFechaInicio,
                                                                    $dFechaFin,
                                                                    $nIdMarca,
                                                                    $nIdModelo,
                                                                    $nIdEstadoCotizacion,
                                                                    Auth::user()->id
                                                                    ));

        $arrayCotizaciones = ParametroController::arrayPaginator($arrayCotizaciones, $request);
        return ['arrayCotizaciones'=>$arrayCotizaciones];
    }

    public function GetRefVehiculoByContacto(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdContacto = $request->nidcontacto;

        $arraySegReferenciavehiculo = DB::select('exec usp_Cotizacion_GetRefVehiculoByContacto ?, ?, ?, ?',
                                                                        array(  $nIdEmpresa,
                                                                                $nIdSucursal,
                                                                                $nIdContacto,
                                                                                Auth::user()->id
                                                                                ));

        $arraySegReferenciavehiculo = ParametroController::arrayPaginator($arraySegReferenciavehiculo, $request);
        return ['arraySegReferenciavehiculo'=>$arraySegReferenciavehiculo];
    }
}
