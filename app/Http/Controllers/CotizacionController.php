<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NotifyDashboard;
use App\User;

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

        $nidproveedor       = $request->nidproveedor;
        $nidtipolista       = $request->nidtipolista;
        $nidlinea           = $request->nidlinea;
        $nidmarca           = $request->nidmarca;
        $nidmodelo          = $request->nidmodelo;
        $cnombrecomercial   = $request->cnombrecomercial;

        $cnombrecomercial   = ($cnombrecomercial == "") ? ($cnombrecomercial = '') : $cnombrecomercial;

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

        $arrayCabeceraCotizacion = DB::select('exec [usp_Cotizacion_SetCabeceraCotizacion] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
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
                                                                    $request->nIdSubLinea,
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
                $arrayDetalleCoti =  DB::select('exec [usp_Cotizacion_SetDetalleCotizacion] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                                    [   $request->nIdCabeCoti,          //nIdCabeceraCotizacion
                                                                        $request->fTipoCambioComercial, //fTipoCambioComercial
                                                                        $det['flagTipoItem'],           //flagTipoItem
                                                                        $det['codigo'],                 //ListaPrecio
                                                                        0,                              //ElementoVenta
                                                                        0,                              //EventoElementoVenta
                                                                        'N',                            //FlagActivaEvento
                                                                        0,                              //ObsequioElementoVenta
                                                                        'N',                            //FlagActivaObsequio
                                                                        $det['nidmoneda'],
                                                                        $det['cantidad'],
                                                                        $det['preciofinal'],
                                                                        $det['sobreprecio'],
                                                                        $det['dscto'],
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
                    DB::select('exec [usp_Cotizacion_SetDetalleCotizacion] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                                    [   $request->nIdCabeCoti,          //nIdCabeceraCotizacion
                                                                        $request->fTipoCambioComercial, //fTipoCambioComercial
                                                                        $det['flagTipoItem'],           //flagTipoItem
                                                                        0,                              //ListaPrecio
                                                                        $det['codigoEV'],               //ElementoVenta
                                                                        0,                              //EventoElementoVenta
                                                                        'N',                            //FlagActivaEvento
                                                                        $det['codigoOEV'],              //ObsequioElementoVenta
                                                                        'S',                            //FlagActivaObsequio
                                                                        $det['nidmoneda'],
                                                                        $det['cantidad'],
                                                                        $det['preciofinal'],
                                                                        0,
                                                                        $det['dscto'],
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
                    DB::select('exec [usp_Cotizacion_SetDetalleCotizacion] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                                    [   $request->nIdCabeCoti,          //nIdCabeceraCotizacion
                                                                        $request->fTipoCambioComercial, //fTipoCambioComercial
                                                                        $det['flagTipoItem'],           //flagTipoItem
                                                                        0,                              //ListaPrecio
                                                                        $det['codigo'],                 //ElementoVenta
                                                                        0,                              //EventoElementoVenta
                                                                        'N',                            //FlagActivaEvento
                                                                        0,                              //ObsequioElementoVenta
                                                                        'N',                            //FlagActivaObsequio
                                                                        $det['nidmoneda'],
                                                                        $det['cantidad'],
                                                                        $det['preciofinal'],
                                                                        0,
                                                                        $det['dscto'],
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
                    DB::select('exec [usp_Cotizacion_SetDetalleCotizacion] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                                    [   $request->nIdCabeCoti,          //nIdCabeceraCotizacion
                                                                        $request->fTipoCambioComercial, //fTipoCambioComercial
                                                                        $det['flagTipoItem'],           //flagTipoItem
                                                                        0,                              //ListaPrecio
                                                                        $det['codigoEV'],               //ElementoVenta
                                                                        $det['codigoEEV'],              //EventoElementoVenta
                                                                        'S',                            //FlagActivaEvento
                                                                        0,                              //ObsequioElementoVenta
                                                                        'N',                            //FlagActivaObsequio
                                                                        $det['nidmoneda'],
                                                                        $det['cantidad'],
                                                                        $det['preciofinal'],
                                                                        0,
                                                                        $det['dscto'],
                                                                        $det['preciofinal'],
                                                                        Auth::user()->id
                                                                    ]);
                }
            }

            //Capturo el nIdCabeceraCotizacion
            $nIdCabeceraCotizacion =  $arrayDetalleCoti[0]->nIdCabeceraCotizacion;

            //Obtengo datos del Supera Dscto para validar si se Aprueba o No el Pedido Automaticamente
            $arrayDatosCotizacion = DB::select('exec [usp_Cotizacion_GetDatosCotizacion] ? ', [ $nIdCabeceraCotizacion ]);

            $contAprobacionGerencia = 0;
            $contAprobacionADV = 0;

            //Recorrer todos los detalles de la Cotización
            foreach ($arrayDatosCotizacion as $value) {
                //Si el detalle de cotización es de tipo Vehiculo
                if ($value->cFlagTipoItem == 'V') {
                    //Verificar si existe Dscto
                    if (floatval($value->fDescuento) > 0) {
                        //Si supera dscto, aumenta el cont de Gerencia
                        $contAprobacionGerencia++;
                    }
                } else {
                    //Si el detalle de cotización es de tipo => EV, Obsq o Campaña
                    //Verificar si es una camapaña o obsequio
                    if ($value->cFlagActivaEventoCampania == 'S' || $value->cFlagActivaObsequio == 'S' ) {
                        //Si es evento y/o obsequio, aumenta el cont de ADV
                        $contAprobacionADV++;
                    }
                }
            }

            $data = [
                'nIdCabeceraCotizacion'     => $nIdCabeceraCotizacion,
                'contAprobacionGerencia'    => $contAprobacionGerencia,
                'contAprobacionADV'         => $contAprobacionADV
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
        $nIdEmpresa             =   $request->nidempresa;
        $nIdSucursal            =   $request->nidsucursal;
        $dFechaInicio           =   $request->dfechainicio;
        $dFechaFin              =   $request->dfechafin;
        $nIdMarca               =   $request->nidmarca;
        $nIdModelo              =   $request->nidmodelo;
        $cNumeroCotizacion      =   $request->cnumerocotizacion;
        $nIdEstadoCotizacion    =   $request->nidestadocotizacion;
        $cContacto              =   $request->ccontacto;
        $ntipopersona           =   $request->ntipopersona;

        $dFechaInicio           =   ($dFechaInicio == NULL) ? ($dFechaInicio = '') : $dFechaInicio;
        $dFechaFin              =   ($dFechaFin == NULL) ? ($dFechaFin = '') : $dFechaFin;
        $nIdMarca               =   ($nIdMarca == NULL) ? ($nIdMarca = 0) : $nIdMarca;
        $nIdModelo              =   ($nIdModelo == NULL) ? ($nIdModelo = 0) : $nIdModelo;
        $cNumeroCotizacion      =   ($cNumeroCotizacion == NULL) ? ($cNumeroCotizacion = '') : $cNumeroCotizacion;
        $nIdEstadoCotizacion    =   ($nIdEstadoCotizacion == NULL) ? ($nIdEstadoCotizacion = 0) : $nIdEstadoCotizacion;
        $cContacto              =   ($cContacto == NULL) ? ($cContacto = '') : $cContacto;
        $ntipopersona           =   ($ntipopersona == NULL) ? ($ntipopersona = 1) : $ntipopersona;

        $arrayCotizaciones = DB::select('exec [usp_Cotizacion_GetListCotizacionesByIdVendedor] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                                [   $nIdEmpresa,
                                                                    $nIdSucursal,
                                                                    $dFechaInicio,
                                                                    $dFechaFin,
                                                                    $nIdMarca,
                                                                    $nIdModelo,
                                                                    $cNumeroCotizacion,
                                                                    $nIdEstadoCotizacion,
                                                                    $cContacto,
                                                                    $ntipopersona,
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

        $nIdUsuario = Auth::user()->id;

        if($request->opcion == 1) {
            $dfecha     = date('Y-m-d');;

            $nIdUsuario = ($nIdUsuario == NULL) ? ($nIdUsuario = 0) : $nIdUsuario;

            $dashboard = DB::select('EXEC usp_Dashboard_GetCotizacionesByUsuario ?, ?',
                                                            [
                                                                $nIdUsuario,
                                                                $dfecha
                                                            ]);

            // User::findOrFail($nIdUsuario)->notify(new NotifyDashboard($dashboard));
        }

        $arrayCabeceraCotizacion = DB::select('exec [usp_Cotizacion_SetCambiarEstadoCotizacion] ?, ?, ?',
                                                                [   $request->nIdCabeceraCotizacion,
                                                                    $request->opcion,
                                                                    // $request->nIdEstadoCotizacion,
                                                                    // $request->cFlagEstadoCotizacion,
                                                                    $nIdUsuario
                                                                ]);

        return response()->json($arrayCabeceraCotizacion);
    }

    public function GetLstCotizacionPendientes(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nidempresa     =   $request->nidempresa;
        $nidsucursal    =   $request->nidsucursal;
        $nidmarca       =   $request->nidmarca;
        $nidmodelo      =   $request->nidmodelo;
        $dfechainicio   =   $request->dfechainicio;
        $dfechafin      =   $request->dfechafin;
        $cContacto      =   $request->ccontacto;
        $ntipopersona   =   $request->ntipopersona;

        $nidmarca       =   ($nidmarca == NULL) ? ($nidmarca = 0) : $nidmarca;
        $nidmodelo      =   ($nidmodelo == NULL) ? ($nidmodelo = 0) : $nidmodelo;
        $dfechainicio   =   ($dfechainicio == NULL) ? ($dfechainicio = '') : $dfechainicio;
        $dfechafin      =   ($dfechafin == NULL) ? ($dfechafin = '') : $dfechafin;
        $cContacto      =   ($cContacto == NULL) ? ($cContacto = '') : $cContacto;
        $ntipopersona   =   ($ntipopersona == NULL) ? ($ntipopersona = 1) : $ntipopersona;

        $arrayCotizacionesPendientes = DB::select('exec [usp_Cotizacion_GetLstCotizacionPendiente] ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                    [
                                        $nidempresa,
                                        $nidsucursal,
                                        $nidmarca,
                                        $nidmodelo,
                                        $dfechainicio,
                                        $dfechafin,
                                        $cContacto,
                                        $ntipopersona,
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

        $nIdCabeceraCotizacion      =   $request->nIdCabeceraCotizacion;
        $cflagVerificaDistribucion  =   $request->cflagVerificaDistribucion;

        $arrayDistribucionDescuento = DB::select('exec usp_Cotizacion_GetDistribucionBySuperaDscto ?, ?, ?',
                                    [
                                        $nIdCabeceraCotizacion,
                                        $cflagVerificaDistribucion,
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
            //Si el detalle de cotización es de tipo Vehiculo
            if ($value->cFlagTipoItem == 'V') {
                //Verificar si existe Dscto
                if (floatval($value->fDescuento) > 0) {
                    //Si supera dscto, aumenta el cont de Gerencia
                    $contGerencia++;
                }
            } else {
                //Si el detalle de cotización es de tipo => EV, Obsq o Campaña
                //Verificar si es una camapaña o obsequio
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
                    $arrayDetalleCoti = DB::select('exec [usp_Cotizacion_SetDistribucionCotizacion] ?, ?, ?, ?, ?, ?',
                                                                    [   $det['nIdCabeceraCotizacion'],
                                                                        $det['nIdDetalleCotizacion'],
                                                                        $det['nIdProveedor'],
                                                                        $det['fDistribucion'],
                                                                        $det['fMontoDesembolsar'],
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

    public function GetDetalleCotizacion(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa             =   $request->nIdEmpresa;
        $nIdSucursal            =   $request->nIdSucursal;
        $nIdCabeceraCotizacion  =   $request->nIdCabeceraCotizacion;

        $logo                   =   public_path('img/automotoresinka.png');//CAPTURO LA RUTA DEL LOGO
        $hyundai                =   public_path('img/hyundai.png');//CAPTURO LA RUTA DE HYUNDAI

        $arrayDetalleCotizacion = DB::select('exec [usp_Cotizacion_GetDetalleCotizacion] ?, ?, ?',
                                    [
                                        $nIdEmpresa,
                                        $nIdSucursal,
                                        $nIdCabeceraCotizacion
                                    ]);

        $arrayDatosBanco = DB::select('exec [usp_Banco_GetDatosBanco]');


        //OBTENGO LAS URL DE LOS ARCHIVOS ASOCIADOS AL MODELO/AÑO
        $arrayDetalleDocs = DB::select('exec [usp_Cotizacion_GetDocs]  ?',
                                    [
                                        $nIdCabeceraCotizacion
                                    ]);

        $ip_address = request()->ip();

        if ($arrayDetalleDocs[0]->cFichaImageUrl != null) {
            if ($arrayDetalleDocs[0]->cFichaTecnicaSubstring == 1) {
                //OBTENGO LA RUTA DINAMICA DE LA FICHA TECNICA
                $cadena     =   substr($arrayDetalleDocs[0]->cFichaImageUrl, 44); // Para Obtener Archivo Http
                //OBTENGO EL CONTENIDO DE LA FICHA TECNICA => storage/app/public/ . RUTADINAMICA

                //Primero Verificar desde donde se va obtener el Archivo (Si es desde Local o Produc)
                if($ip_address == '::1') {
                    $contents   =   DB::unprepared(\File::get($arrayDetalleDocs[0]->cFichaImageUrl));
                } else {
                    $contents   =   Storage::get('public/'. $cadena);
                }
            } else {
                //OBTENGO LA RUTA DINAMICA DE LA FICHA TECNICA
                $cadena     =   substr($arrayDetalleDocs[0]->cFichaImageUrl, 47); // Para Obtener Archivo Local
                //OBTENGO EL CONTENIDO DE LA FICHA TECNICA => storage/app/public/ . RUTADINAMICA
                $contents   =   Storage::get('public/'. $cadena);
            }
        }

        // $data_xml = new \DOMDocument('1.0','UTF-8'); //creo el objeto
        // $data_xml->loadXML($contents); //cargo el xml, en este caso es una cadena codificada
        // $data1 = $data_xml->getElementsByTagNameNS('SGS_FichaTec_Cotizacion' ,'textbox21');//busca el elemento del xml y lo guarda en variable
        // // $data_xml->load($arrayDetalleDocs[0]->cFichaImageUrl); //cargo el xml, en este caso desde una ruta
        // // $data2 = $data_xml->getElementsByTagName('textbox21');//busca el elemento del xml y lo guarda en variables
        $feed   =   file_get_contents($arrayDetalleDocs[0]->cFichaImageUrl);
        $xml    =   simplexml_load_string($feed,'SimpleXMLElement', LIBXML_NOWARNING);
        // $xml    =   simplexml_load_file($contents);
        $tabla='<table  border="1" align="center" cellspacing="0" cellpadding="0" style="font-size:10px;width:100px;">';
        $fila=0;
        $j=0;

        foreach($xml as $z => $a){
            if($j==2){
                foreach($a as $x => $b){
                    //echo count($b);
                    //echo "<pre>"; print_r($b->table1_Group1); echo "</pre>";
                    for($l=0;$l<count($b);$l++){
                        //echo "<pre>"; print_r($b->table1_Group1[$l]); echo "</pre>";
                        for($m=0;$m<count($b->table1_Group1[$l]);$m++){
                            //echo "<pre>"; print_r($b->table1_Group1[$l][$m]->table1_Group2_Collection->table1_Group2); echo "</pre>";
                            $art=(array)$b->table1_Group1[$l][$m]->table1_Group2_Collection->table1_Group2;
                            //echo "<pre>"; print_r(utf8_decode($art['@attributes']['textbox3'])); echo "</pre>";
                            //echo var_dump($art);
                            //echo "<pre>"; print_r($art); echo "</pre>";
                            //echo "<pre>"; print_r($art['@attributes']); echo "</pre>";
                            //echo "<pre>"; print_r($art['Detail_Collection']->Detail); echo "</pre>";
                            $art_detalle=$art['Detail_Collection'];
                            //echo "cab: ".$art['@attributes'];
                            //echo "<pre>"; print_r($art_detalle[$m]); echo "</pre>";
                            //echo "cant: ".count($art_detalle[$m])."<br>";
                            //echo "<pre>"; print_r($art_detalle[$m]
                            //unset($art);->Detail[0]); echo "</pre>";
                            if(strlen($art['@attributes']['textbox3'])==0) break;
                            $tabla.='<tr><th colspan="2" align="center">'.utf8_decode($art['@attributes']['textbox3']).'</th></tr>';
                            $fila++;
                            for($n=0;$n<count($art_detalle[$m]);$n++) {
                                $art_detalle2=(array)$art_detalle[$m]->Detail[$n];
                                //echo "<pre>"; print_r($art_detalle2['@attributes']['textbox6']); echo "</pre>";
                                //echo "<pre>"; print_r($art_detalle2['@attributes']['textbox14']); echo "</pre>";
                                $tabla.='<tr><td align="left">'.utf8_decode($art_detalle2['@attributes']['textbox6']).'</td>';
                                $tabla.='<td>'.utf8_decode($art_detalle2['@attributes']['textbox14']).'</td></tr>';
                                $fila++;
                            }
                            unset($art);
                            unset($art_detalle);
                            unset($art_detalle2);
                        }
                    }
                }
            }
            $j++;
        }

        $tabla.='</table>';
        //echo "num filas: ".$fila."<br>";
        //echo $tabla;
        $num_filas  =   ($fila-17);
        $num_veces  =   (int)(($fila-17)/17);
        $ord        =   $num_filas/$num_veces;
        //echo "-- ".$ord."<br>";
        $sw=false;

        if($ord>28) {
            $r= round(($ord/28),2);
            if(($r>=1.01 && $r<=1.3) || ($r>=2.01 && $r<=2.3)) {
                $sw=true;
            }
        }

        // return $tabla;

        $pdf = \PDF::loadView('pdf.cotizacion.cotizacion', [
                                                                'arrayDetalleCotizacion' => $arrayDetalleCotizacion,
                                                                'arrayDetalleDocs'      =>  $arrayDetalleDocs,
                                                                'contents'              =>  $contents,
                                                                'arrayDatosBanco'       =>  $arrayDatosBanco,
                                                                'logo'                  =>  $logo,
                                                                'hyundai'               =>  $hyundai,
                                                                'tabla'   =>  $tabla
                                                            ]);

        return $pdf->download('Cotización -'.$nIdCabeceraCotizacion.'.pdf');
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

    public function GetListContactoByVendedor(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdCronograma = $request->nidcronograma;
        $nTipoPersona = $request->ntipopersona;
        $cNroDocumento = $request->cnrodocumento;
        $cFiltroDescripcion = $request->cfiltrodescripcion;
        $nIdVendedor = $request->nidvendedor;

        $cNroDocumento = ($cNroDocumento == NULL) ? ($cNroDocumento = ' ') : $cNroDocumento;
        $cFiltroDescripcion = ($cFiltroDescripcion == NULL) ? ($cFiltroDescripcion = ' ') : $cFiltroDescripcion;
        $nIdVendedor = ($nIdVendedor == NULL) ? ($nIdVendedor = Auth::user()->id) : $nIdVendedor;

        $arrayContactosPorVendedor = DB::select('exec [usp_Cotizacion_GetListContactoByVendedor] ?, ?, ?, ?, ?, ?, ?',
                                                                        array(  $nIdEmpresa,
                                                                                $nIdSucursal,
                                                                                $nIdCronograma,
                                                                                $nTipoPersona,
                                                                                $cNroDocumento,
                                                                                $cFiltroDescripcion,
                                                                                $nIdVendedor
                                                                                ));

        $arrayContactosPorVendedor = ParametroController::arrayPaginator($arrayContactosPorVendedor, $request);
        return ['arrayContactosPorVendedor'=>$arrayContactosPorVendedor];
    }
}
