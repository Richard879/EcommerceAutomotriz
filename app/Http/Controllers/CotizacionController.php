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

        $arrayCabeceraCotizacion = DB::select('exec [usp_Cotizacion_SetCabeceraCotizacion] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                                [   $request->nIdAsignacionContactoVendedor,
                                                                    $request->cNumeroCotizacion,
                                                                    $request->nIdEmpresa,
                                                                    $request->nIdSucursal,
                                                                    $request->nIdContacto,
                                                                    $request->nIdReferencia,
                                                                    $request->dFechaCotizacion,
                                                                    $request->dFechaVencimientoCotizacion,
                                                                    $request->fTipoCambioVenta,
                                                                    $request->fTipoCambioCompra,
                                                                    $request->fTipoCambioComercial,
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

            //================ VEHICULO =======================
            $arrayvehiculos = $request->arrayvehiculos;
            foreach($arrayvehiculos as $ep=>$det)
            {
                $fDy = $request->fDy;
                $fDy = ($fDy == NULL) ? ($fDy = 0) : $fDy;

                $arrayDetalleCoti =  DB::select('exec [usp_Cotizacion_SetDetalleCotizacion] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                                    [   $request->nIdCabeCoti,
                                                                        $request->fTipoCambioComercial,
                                                                        $det['flagTipoItem'],
                                                                        $det['codigo'],         //ListaPrecio
                                                                        0,                      //ElementoVenta
                                                                        0,                      //EventoElementoVenta
                                                                        'N',                    //FlagElementoVenta
                                                                        0,                      //ObsequioElementoVenta
                                                                        'N',                    //FlagActivaObsequio
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

            //================ OBSEQUIOS =======================
            $arrayevporregalarlength = sizeof($request->arrayobsequios);
            if($arrayevporregalarlength > 0){
                $arrayobsequios = $request->arrayobsequios;
                foreach($arrayobsequios as $ep=>$det)
                {
                    DB::select('exec [usp_Cotizacion_SetDetalleCotizacion] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                                    [   $request->nIdCabeCoti,
                                                                        $request->fTipoCambioComercial,
                                                                        $det['flagTipoItem'],
                                                                        0,                          //ListaPrecio
                                                                        $det['codigoEV'],           //ElementoVenta
                                                                        0,                          //EventoElementoVenta
                                                                        'N',                        //FlagElementoVenta
                                                                        $det['codigoOEV'],          //ObsequioElementoVenta
                                                                        'S',                        //FlagActivaObsequio
                                                                        'N',                        //SuperaDescuento
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

            //================ ELEMENTOS DE VENTA =======================
            $arrayelemventalength = sizeof($request->arrayelemventa);
            if($arrayelemventalength > 0){
                $arrayelemventa = $request->arrayelemventa;
                foreach($arrayelemventa as $ep=>$det)
                {
                    DB::select('exec [usp_Cotizacion_SetDetalleCotizacion] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                                    [   $request->nIdCabeCoti,
                                                                        $request->fTipoCambioComercial,
                                                                        $det['flagTipoItem'],
                                                                        0,                          //ListaPrecio
                                                                        $det['codigo'],             //ElementoVenta
                                                                        0,                          //EventoElementoVenta
                                                                        'N',                        //FlagElementoVenta
                                                                        0,                          //ObsequioElementoVenta
                                                                        'N',                        //FlagActivaObsequio
                                                                        'N',                        //SuperaDescuento
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

            //================ CAMPAÑAS =======================
            $arrayeventoelemventalength = sizeof($request->arrayeventoeleventa);
            if($arrayeventoelemventalength > 0){
                $arrayeventoeleventa = $request->arrayeventoeleventa;
                //Itera todas las referencias de vehiculos
                foreach($arrayeventoeleventa as $ep=>$det)
                {
                    DB::select('exec [usp_Cotizacion_SetDetalleCotizacion] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                                    [   $request->nIdCabeCoti,
                                                                        $request->fTipoCambioComercial,
                                                                        $det['flagTipoItem'],
                                                                        0,                  //ListaPrecio
                                                                        $det['codigoEV'],   //ElementoVenta
                                                                        $det['codigoEEV'],  //EventoElementoVenta
                                                                        'S',                //FlagElementoVenta
                                                                        0,                  //ObsequioElementoVenta
                                                                        'N',                //FlagActivaObsequio
                                                                        'N',                //SuperaDescuento
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

            //Obtengo datos del Supera Dscto para validar si se Aprueba o No el Pedido Automaticamente
            $arrayDatosCotizacion = DB::select('exec [usp_Cotizacion_GetDatosCotizacion] ? ', [ $nIdCabeceraCotizacion ]);

            $contGerencia = 0;
            $contADV = 0;

            //Recorrer todos los detalles de la Cotización
            foreach ($arrayDatosCotizacion as $value) {
                //Si el detalle es un Vehiculo
                if ($value->cFlagTipoItem == 'V') {
                    //Verifica si supera dscto
                    if ($value->cFlagSuperaDescuento == 'S' ) {
                        //Si supera aumenta el cont de Gerencia
                        $contGerencia++;
                    }
                } else {
                    //Si el detalle es EV, Obs o Campaña
                    //Verifica si es una camapaña o obsequio
                    if ($value->cFlagActivaEventoCampania == 'S' || $value->cFlagActivaObsequio == 'S' ) {
                        //Si es evento y/o obsequio, aumenta el cont de ADV
                        $contADV++;
                    }
                }
            }

            $data = [
                'nIdCabeceraCotizacion' => $nIdCabeceraCotizacion,
                'contGerencia'          => $contGerencia,
                'contADV'               => $contADV
            ];

            // $data = [
            //     'arrayDatosCotizacion' => $arrayDatosCotizacion
            // ];

            DB::commit();
            return response()->json($data);
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function GetListCampañasByVehiculo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdProveedor       = $request->nidproveedor;
        $dFecha             = $request->fecha;
        $nIdCodigo          = $request->nidcodigo;
        $nAnioFabricacion   = $request->naniofabricacion;
        $nAnioModelo        = $request->naniomodelo;
        $nTipo              = $request->tipo;

        $nAnioFabricacion = ($nAnioFabricacion == NULL) ? ($nAnioFabricacion = 0) : $nAnioFabricacion;
        $nAnioModelo = ($nAnioModelo == NULL) ? ($nAnioModelo = 0) : $nAnioModelo;

        $arrayEventoCampania = DB::select('exec [usp_Cotizacion_GetListCampañasByVehiculo] ?, ?, ?, ?, ?, ?',
                                                                        [   $nIdProveedor,
                                                                            $dFecha,
                                                                            $nIdCodigo,
                                                                            $nAnioFabricacion,
                                                                            $nAnioModelo,
                                                                            $nTipo
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
        $cNumeroCotizacion = $request->cnumerocotizacion;
        $nIdEstadoCotizacion = $request->nidestadocotizacion;

        $dFechaInicio = ($dFechaInicio == NULL) ? ($dFechaInicio = '') : $dFechaInicio;
        $dFechaFin = ($dFechaFin == NULL) ? ($dFechaFin = '') : $dFechaFin;
        $nIdMarca = ($nIdMarca == NULL) ? ($nIdMarca = 0) : $nIdMarca;
        $nIdModelo = ($nIdModelo == NULL) ? ($nIdModelo = 0) : $nIdModelo;
        $cNumeroCotizacion = ($cNumeroCotizacion == NULL) ? ($cNumeroCotizacion = '') : $cNumeroCotizacion;
        $nIdEstadoCotizacion = ($nIdEstadoCotizacion == NULL) ? ($nIdEstadoCotizacion = 0) : $nIdEstadoCotizacion;

        $arrayCotizaciones = DB::select('exec [usp_Cotizacion_GetListCotizacionesByIdVendedor] ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                                [   $nIdEmpresa,
                                                                    $nIdSucursal,
                                                                    $dFechaInicio,
                                                                    $dFechaFin,
                                                                    $nIdMarca,
                                                                    $nIdModelo,
                                                                    $cNumeroCotizacion,
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
        // print_r($request->nIdCabeceraCotizacion . ' - '. $request->opcion . ' - ' . Auth::user()->id);

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

    public function GetLstCotizacionPendientes(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nidempresa    =   $request->nidempresa;
        $nidsucursal   =   $request->nidsucursal;
        $nidmarca      =   $request->nidmarca;
        $nidmodelo     =   $request->nidmodelo;
        $dfechainicio  =   $request->dfechainicio;
        $dfechafin     =   $request->dfechafin;

        $nidmarca = ($nidmarca == NULL) ? ($nidmarca = 0) : $nidmarca;
        $nidmodelo = ($nidmodelo == NULL) ? ($nidmodelo = 0) : $nidmodelo;
        $dfechainicio = ($dfechainicio == NULL) ? ($dfechainicio = '') : $dfechainicio;
        $dfechafin = ($dfechafin == NULL) ? ($dfechafin = '') : $dfechafin;

        $arrayCotizacionesPendientes = DB::select('exec [usp_Cotizacion_GetLstCotizacionPendiente] ?, ?, ?, ?, ?, ?, ?',
                                    [
                                        $nidempresa,
                                        $nidsucursal,
                                        $nidmarca,
                                        $nidmodelo,
                                        $dfechainicio,
                                        $dfechafin,
                                        Auth::user()->id
                                    ]);

        $arrayCotizacionesPendientes = ParametroController::arrayPaginator($arrayCotizacionesPendientes, $request);
        return ['arrayCotizacionesPendientes'=>$arrayCotizacionesPendientes];
    }

    /*public function GetLstCotizacionPendienteADV(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nidempresa    =   $request->nidempresa;
        $nidsucursal   =   $request->nidsucursal;
        $nidmarca      =   $request->nidmarca;
        $nidmodelo     =   $request->nidmodelo;
        $dfechainicio  =   $request->dfechainicio;
        $dfechafin     =   $request->dfechafin;

        $nidmarca = ($nidmarca == NULL) ? ($nidmarca = 0) : $nidmarca;
        $nidmodelo = ($nidmodelo == NULL) ? ($nidmodelo = 0) : $nidmodelo;
        $dfechainicio = ($dfechainicio == NULL) ? ($dfechainicio = '') : $dfechainicio;
        $dfechafin = ($dfechafin == NULL) ? ($dfechafin = '') : $dfechafin;

        $arrayMisCotizacionesPendientes = DB::select('exec usp_Cotizacion_GetLstCotizacionPendienteADV ?, ?, ?, ?, ?, ?, ?',
                                    [
                                        $nidempresa,
                                        $nidsucursal,
                                        $nidmarca,
                                        $nidmodelo,
                                        $dfechainicio,
                                        $dfechafin,
                                        Auth::user()->id
                                    ]);

        $arrayMisCotizacionesPendientes = ParametroController::arrayPaginator($arrayMisCotizacionesPendientes, $request);
        return ['arrayMisCotizacionesPendientes'=>$arrayMisCotizacionesPendientes];
    }*/

    public function GetDistribucionByElementoVenta(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdCabeceraCotizacion    =   $request->nIdCabeceraCotizacion;

        $arrayDistribucionEVPorRegalar = DB::select('exec [usp_Cotizacion_GetDistribucionByElementoVenta] ?, ?',
                                    [
                                        $nIdCabeceraCotizacion,
                                        Auth::user()->id
                                    ]);

        return response()->json($arrayDistribucionEVPorRegalar);
    }

    public function GetDistribucionBySuperaDscto(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdCabeceraCotizacion    =   $request->nIdCabeceraCotizacion;

        $arrayDistribucionDescuento = DB::select('exec usp_Cotizacion_GetDistribucionBySuperaDscto ?, ?',
                                    [
                                        $nIdCabeceraCotizacion,
                                        Auth::user()->id
                                    ]);

        return response()->json($arrayDistribucionDescuento);
    }

    public function GetDatosCotizacion(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdCabeceraCotizacion  = $request->nIdCabeceraCotizacion;

        $arrayDatosCotizacion = DB::select('exec [usp_Cotizacion_GetDatosCotizacion] ? ', [ $nIdCabeceraCotizacion ]);

        $contGerencia = 0;
        $contADV = 0;

        //Recorrer todos los detalles de la Cotización
        foreach ($arrayDatosCotizacion as $value) {
            //Si el detalle es un Vehiculo
            if ($value->cFlagTipoItem == 'V') {
                //Verifica si supera dscto
                if ($value->cFlagSuperaDescuento == 'S' ) {
                    //Si supera aumenta el cont de Gerencia
                    $contGerencia++;
                }
            } else {
                //Si el detalle es EV, Obs o Campaña
                //Verifica si es una camapaña o obsequio
                if ($value->cFlagActivaEventoCampania == 'S' || $value->cFlagActivaObsequio == 'S' ) {
                    //Si es evento y/o obsequio, aumenta el cont de ADV
                    $contADV++;
                }
            }
        }

        $data = [
            'nIdCabeceraCotizacion' => $nIdCabeceraCotizacion,
            'contGerencia'          => $contGerencia,
            'contADV'               => $contADV
        ];
        return response()->json($data);
    }

    public function SetDistribucionCotizacion(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $listDistribucionDescuentolength = sizeof($request->listDistribucionDescuento);
            if($listDistribucionDescuentolength > 0){
                $listDistribucionDescuento = $request->listDistribucionDescuento;
                foreach($listDistribucionDescuento as $ep=>$det)
                {
                    $arrayDetalleCoti = DB::select('exec [usp_Cotizacion_SetDistribucionCotizacion] ?, ?, ?, ?, ?',
                                                                    [   $det['nIdCabeceraCotizacion'],
                                                                        $det['nIdDetalleCotizacion'],
                                                                        $det['nIdProveedor'],
                                                                        $det['fDistribucion'],
                                                                        Auth::user()->id
                                                                    ]);
                }
            }

            // $listDistribucionEVPorRegalarlength = sizeof($request->listDistribucionEVPorRegalar);
            // if($listDistribucionEVPorRegalarlength > 0){
            //     $listDistribucionEVPorRegalar = $request->listDistribucionEVPorRegalar;
            //     foreach($listDistribucionEVPorRegalar as $ep=>$det)
            //     {
            //         $arrayDetalleCoti = DB::select('exec [usp_Cotizacion_SetDistribucionCotizacion] ?, ?, ?, ?, ?',
            //                                                         [   $det['nIdCabeceraCotizacion'],
            //                                                             $det['nIdDetalleCotizacion'],
            //                                                             $det['nIdProveedor'],
            //                                                             $det['fDistribucion'],
            //                                                             Auth::user()->id
            //                                                         ]);
            //     }
            // }

            if($listDistribucionDescuentolength > 0) {
                //Capturo el nIdCabeceraCotizacion
                $nIdCabeceraCotizacion =  $arrayDetalleCoti[0]->nIdCabeceraCotizacion;
            } else {
                //Capturo el nIdCabeceraCotizacion
                $nIdCabeceraCotizacion =  $arrayDetalleCoti[0]->nIdCabeceraCotizacion;
            }

            DB::commit();
            return response()->json($nIdCabeceraCotizacion);
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function GetLstDetalleCotizacion(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa     =   $request->nidempresa;
        $nIdSucursal    =   $request->nidsucursal;
        $nIdCabeceraCotizacion  = $request->nidcabeceracotizacion;
        $variable   = $request->opcion;
        $variable = ($variable == NULL) ? ($variable = 0) : $variable;

        $arrayDetalleCotizacion = DB::select('exec [usp_Cotizacion_GetLstDetalleCotizacion] ?, ?, ?',
                                    [
                                        $nIdEmpresa,
                                        $nIdSucursal,
                                        $nIdCabeceraCotizacion
                                    ]);
        if($variable == "0"){
            $arrayDetalleCotizacion = ParametroController::arrayPaginator($arrayDetalleCotizacion, $request);
        }
        return ['arrayDetalleCotizacion'=>$arrayDetalleCotizacion];
    }

    public function GetListObsequiosByVehiculo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdProveedor       = $request->nidproveedor;
        $dFecha             = $request->fecha;
        $nIdCodigo          = $request->nidcodigo;
        $nAnioFabricacion   = $request->naniofabricacion;
        $nAnioModelo        = $request->naniomodelo;
        $nTipo              = $request->tipo;

        $nAnioFabricacion = ($nAnioFabricacion == NULL) ? ($nAnioFabricacion = 0) : $nAnioFabricacion;
        $nAnioModelo = ($nAnioModelo == NULL) ? ($nAnioModelo = 0) : $nAnioModelo;

        $arrayEventoCampania = DB::select('exec [usp_Cotizacion_GetListObsequiosByVehiculo] ?, ?, ?, ?, ?, ?',
                                                                        [   $nIdProveedor,
                                                                            $dFecha,
                                                                            $nIdCodigo,
                                                                            $nAnioFabricacion,
                                                                            $nAnioModelo,
                                                                            $nTipo
                                                                        ]);

        return response()->json($arrayEventoCampania);
    }

    public function GetListObsequioElementoVenta(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $nIdObsequio  = $request->nidobsequio;

        $arrayObsequioEleVenta = DB::select('exec [usp_Cotizacion_GetListObsequioElementoVenta] ?',
                                                                        [   $nIdObsequio
                                                                        ]);

        return response()->json($arrayObsequioEleVenta);
    }
}
