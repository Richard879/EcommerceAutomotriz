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

        $arrayTipoLista = DB::select('exec [usp_Cotizacion_GetListTipoLista] ?, ?',
                                                        [   $nidproveedor,
                                                            $tipoLista
                                                        ]);

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

        $arrayListaVehiculos = DB::select('exec [usp_Cotizacion_GetListVehiculos] ?, ?, ?, ?, ?, ?',
                                                                        [   $nidproveedor,
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

        $arrayCabeceraCotizacion = DB::select('exec [usp_Cotizacion_SetCabeceraCotizacion] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                                [   $request->nIdAsignacionContactoVendedor,
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
                                                                    $request->cGlosa,
                                                                    Auth::user()->id
                                                                ]);

        return response()->json($arrayCabeceraCotizacion);
    }

    public function SetDetalleCotizacion(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $arrayvehiculos = $request->arrayvehiculos;
            foreach($arrayvehiculos as $ep=>$det)
            {
                $fDy = $request->fDy;
                $fDy = ($fDy == NULL) ? ($fDy = 0) : $fDy;

                $arrayDetalleCoti =  DB::select('exec [usp_Cotizacion_SetDetalleCotizacion] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                                    [   $request->nIdCabeCoti,
                                                                        $det['flagTipoItem'],
                                                                        $det['codigo'],
                                                                        0,
                                                                        0,
                                                                        'N',
                                                                        $det['flagactivaregalo'],
                                                                        0,
                                                                        ($fDy > 0) ? 'S' : 'N' ,//SI DY ES MAYOR 0 ENTONCES "S" SINO "N"
                                                                        $det['nidmoneda'],
                                                                        $det['cantidad'],
                                                                        $det['preciofinal'],
                                                                        $det['sobreprecio'],
                                                                        $det['dscto'],
                                                                        $fDy,
                                                                        $det['subtotal'],
                                                                        Auth::user()->id
                                                                    ]);
            }

            $arrayevporregalarlength = sizeof($request->arrayevporregalar);
            if($arrayevporregalarlength > 0){
                $arrayevporregalar = $request->arrayevporregalar;
                foreach($arrayevporregalar as $ep=>$det)
                {
                    DB::select('exec [usp_Cotizacion_SetDetalleCotizacion] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                                    [   $request->nIdCabeCoti,
                                                                        $det['flagTipoItem'],
                                                                        0,
                                                                        0,
                                                                        $det['codigo'],
                                                                        'N',
                                                                        $det['flagactivaregalo'],
                                                                        0,
                                                                        'N',
                                                                        $det['nidmoneda'],
                                                                        $det['cantidad'],
                                                                        $det['preciofinal'],
                                                                        0,
                                                                        $det['dscto'],
                                                                        0,
                                                                        $det['subtotal'],
                                                                        Auth::user()->id
                                                                    ]);
                }
            }

            $arrayelemventalength = sizeof($request->arrayelemventa);
            if($arrayelemventalength > 0){
                $arrayelemventa = $request->arrayelemventa;
                foreach($arrayelemventa as $ep=>$det)
                {
                    DB::select('exec [usp_Cotizacion_SetDetalleCotizacion] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                                    [   $request->nIdCabeCoti,
                                                                        $det['flagTipoItem'],
                                                                        0,
                                                                        0,
                                                                        $det['codigo'],
                                                                        'N',
                                                                        $det['flagactivaregalo'],
                                                                        0,
                                                                        'N',
                                                                        $det['nidmoneda'],
                                                                        $det['cantidad'],
                                                                        $det['preciofinal'],
                                                                        0,
                                                                        $det['dscto'],
                                                                        0,
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
                    DB::select('exec [usp_Cotizacion_SetDetalleCotizacion] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                                    [   $request->nIdCabeCoti,
                                                                        $det['flagTipoItem'],
                                                                        0,
                                                                        0,
                                                                        $det['codigoEV'],
                                                                        'S',
                                                                        $det['flagactivaregalo'],
                                                                        $det['codigoEEV'],
                                                                        'N',
                                                                        $det['nidmoneda'],
                                                                        $det['cantidad'],
                                                                        $det['preciofinal'],
                                                                        0,
                                                                        $det['dscto'],
                                                                        0,
                                                                        $det['preciofinal'],
                                                                        Auth::user()->id
                                                                    ]);
                }
            }

            //Capturo el nIdCabeceraCotizacion
            $nIdCabeceraCotizacion =  $arrayDetalleCoti[0]->nIdCabeceraCotizacion;

            //Obtengo datos del Sobre Precio y Dscto para validar si se Aprueba o No el Pedido Automaticamente
            $arrayDatosCotizacion = DB::select('exec usp_Cotizacion_GetDatosCotizacion ? ', [ $nIdCabeceraCotizacion ]);

            //Flags para verificar si existen elemento venta por regalar
            $cFlagActivaEVPorRegalar = 0;
            $cont = 0;
            //recorro todo el detalle de cotización verificando si existen EV Por Regalar
            foreach($arrayDatosCotizacion as $cotizacion) {
                if($cotizacion->cFlagActivaEVPorRegalar == 'S') {
                    $cont ++;
                    $cFlagActivaEVPorRegalar = $cont;
                }
            }

            $data = [
                'arrayDatosCotizacion' => $arrayDatosCotizacion,
                'cFlagActivaEVPorRegalar' => $cFlagActivaEVPorRegalar
            ];

            DB::commit();
            return response()->json($data);
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

        $arrayEventoCampania = DB::select('exec [usp_Cotizacion_GetListCampañasByVehiculo] ?, ?, ?, ?',
                                                                        [   $nidproveedor,
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

        $arrayEventoEleVenta = DB::select('exec [usp_Cotizacion_GetListEventoElementoVenta] ?, ?',
                                                                        [   $fecha,
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

        $nIdMarca = ($nIdMarca == NULL) ? ($nIdMarca = 0) : $nIdMarca;
        $nIdModelo = ($nIdModelo == NULL) ? ($nIdModelo = 0) : $nIdModelo;
        $nIdEstadoCotizacion = ($nIdEstadoCotizacion == NULL) ? ($nIdEstadoCotizacion = 0) : $nIdEstadoCotizacion;

        $arrayCotizaciones = DB::select('exec [usp_Cotizacion_GetListCotizacionesByIdVendedor] ?, ?, ?, ?, ?, ?, ?, ?',
                                                                [   $nIdEmpresa,
                                                                    $nIdSucursal,
                                                                    $dFechaInicio,
                                                                    $dFechaFin,
                                                                    $nIdMarca,
                                                                    $nIdModelo,
                                                                    $nIdEstadoCotizacion,
                                                                    Auth::user()->id
                                                                ]);

        $arrayCotizaciones = ParametroController::arrayPaginator($arrayCotizaciones, $request);
        return ['arrayCotizaciones'=>$arrayCotizaciones];
    }

    public function GetRefVehiculoByContacto(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdContacto = $request->nidcontacto;

        $arraySegReferenciavehiculo = DB::select('exec [usp_Cotizacion_GetRefVehiculoByContacto] ?, ?, ?, ?',
                                                                            [   $nIdEmpresa,
                                                                                $nIdSucursal,
                                                                                $nIdContacto,
                                                                                Auth::user()->id
                                                                            ]);

        $arraySegReferenciavehiculo = ParametroController::arrayPaginator($arraySegReferenciavehiculo, $request);
        return ['arraySegReferenciavehiculo'=>$arraySegReferenciavehiculo];
    }

    public function GetElementoByTipo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa   = $request->nidempresa;
        $nIdTipoElemento = $request->nidtipoelemen;
        $cElemenNombre = $request->celementonombre;
        $nIdTipoElemento = ($nIdTipoElemento == NULL) ? ($nIdTipoElemento = 0) : $nIdTipoElemento;
        $cElemenNombre = ($cElemenNombre == NULL) ? ($cElemenNombre = '') : $cElemenNombre;

        $arrayElementoVenta = DB::select('exec [usp_Cotizacion_GetElementoByTipo] ?, ?, ?',
                                                                [   $nIdEmpresa,
                                                                    $nIdTipoElemento,
                                                                    $cElemenNombre
                                                                ]);

        $arrayElementoVenta = ParametroController::arrayPaginator($arrayElementoVenta, $request);
        return ['arrayElementoVenta'=>$arrayElementoVenta];
    }

    public function SetCambiarEstadoCotizacion(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $arrayCabeceraCotizacion = DB::select('exec [usp_Cotizacion_SetCambiarEstadoCotizacion] ?, ?, ?',
                                                                [   $request->nIdCabeceraCotizacion,
                                                                    $request->opcion,
                                                                    // $request->nIdEstadoCotizacion,
                                                                    // $request->cFlagEstadoCotizacion,
                                                                    Auth::user()->id
                                                                ]);

        return response()->json($arrayCabeceraCotizacion);
    }
}
