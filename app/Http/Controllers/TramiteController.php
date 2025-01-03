<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class TramiteController extends Controller
{
    public function GetPedidosCanceladosByEstadoTramite(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEstadoTramite   = $request->nIdEstadoTramite;
        $cnumvin            = $request->cnumvin;
        $nIdTramitador      = Auth::user()->id;

        $nIdEstadoTramite   = ($nIdEstadoTramite == NULL) ? ($nIdEstadoTramite = 0) : $nIdEstadoTramite;
        $cnumvin            = ($cnumvin == NULL) ? ($cnumvin = '') : $cnumvin;

        $arrayPedidosCancelados = DB::select('exec usp_Tramite_GetPedidosCanceladosByEstadoTramite ?, ?, ?',
                                                            [
                                                                $nIdEstadoTramite,
                                                                $cnumvin,
                                                                $nIdTramitador
                                                            ]);

        $arrayPedidosCancelados = Parametro::arrayPaginator($arrayPedidosCancelados, $request);
        return ['arrayPedidosCancelados'=>$arrayPedidosCancelados];
    }

    public function GetListFiltro(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa     =   $request->nidempresa;
        $nIdGrupoPar    =   $request->nidgrupopar;
        $nJerarquia     =   $request->jerarquia;

        $arrayFiltros = DB::select('exec [usp_Tramite_GetConceptosTramiteByTipo] ?, ?, ?',
                                                        [   $nIdEmpresa,
                                                            $nIdGrupoPar,
                                                            $nJerarquia
                                                        ]);
        return response()->json($arrayFiltros);
    }

    public function SetCabeceraTramite(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            // $arrayPedidoDoumentoNew = $request->arrayPedidoDoumentoNew;
            // if(sizeof($arrayPedidoDoumentoNew) > 0) {
            //     foreach($arrayPedidoDoumentoNew as $ep=>$det)
            //     {
            //         $data = DB::select('exec usp_Tramite_SetActualizarDocumentoPedido ?, ?, ?, ?, ?',
            //                                                             [   $request->nIdCabeceraPedido,
            //                                                                 $det['nIdDocumentoAdjuntoPedido'],
            //                                                                 ($det['cFlagDocumento'] == false) ? 0 : 1,
            //                                                                 floatval($det['fMontoDocumento']),
            //                                                                 Auth::user()->id
            //                                                             ]);
            //     }
            // }

            $nIdTipoPersona         =   $request->fillConceptosDocumentos['nIdTipoPersona'];
            $fCostoLegalizacion     =   $request->fillConceptosDocumentos['fCostoLegalizacion'];
            $fCostoTramiteTarjeta   =   $request->fillConceptosDocumentos['fCostoTramiteTarjeta'];
            $fCostoPlaca            =   $request->fillConceptosDocumentos['fCostoPlaca'];
            $fCostoGarantiaI        =   $request->fillConceptosDocumentos['fCostoGarantiaI'];
            $fCostoNotariales       =   $request->fillConceptosDocumentos['fCostoNotariales'];
            $fCambioCaracteristicas =   $request->fillConceptosDocumentos['fCambioCaracteristicas'];

            $nIdTipoPersona         =   ($nIdTipoPersona == NULL) ? ($nIdTipoPersona = 0) : $nIdTipoPersona;
            $fCostoLegalizacion     =   ($fCostoLegalizacion == NULL) ? ($fCostoLegalizacion = 0) : $fCostoLegalizacion;
            $fCostoTramiteTarjeta   =   ($fCostoTramiteTarjeta == NULL) ? ($fCostoTramiteTarjeta = 0) : $fCostoTramiteTarjeta;
            $fCostoPlaca            =   ($fCostoPlaca == NULL) ? ($fCostoPlaca = 0) : $fCostoPlaca;
            $fCostoGarantiaI        =   ($fCostoGarantiaI == NULL) ? ($fCostoGarantiaI = 0) : $fCostoGarantiaI;
            $fCostoNotariales       =   ($fCostoNotariales == NULL) ? ($fCostoNotariales = 0) : $fCostoNotariales;
            $fCambioCaracteristicas =   ($fCambioCaracteristicas == NULL) ? ($fCambioCaracteristicas = 0) : $fCambioCaracteristicas;

            // REGISTRAR CABECERA DE TRAMITE Y COSTOS SEGUN SEA EL CASO
            $data = DB::select('exec usp_Tramite_SetRegistrarTramite ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                                    [   $request->nIdEmpresa,
                                                                        $request->nIdSucursal,
                                                                        $request->dFechaInicioTramite,
                                                                        $request->dFechaFinTramite,
                                                                        $request->nNroVehiculoTramite,
                                                                        $request->fTotalTramite,
                                                                        $request->nIdEstadoTramite,
                                                                        $request->cFlagEstadoAprobacion,
                                                                        //
                                                                        $nIdTipoPersona,
                                                                        $fCostoLegalizacion,
                                                                        $fCostoTramiteTarjeta,
                                                                        $fCostoPlaca,
                                                                        $fCostoGarantiaI,
                                                                        $fCostoNotariales,
                                                                        $fCambioCaracteristicas,
                                                                        Auth::user()->id
                                                                    ]);

            DB::commit();

            //OBTENGO DATA DE LA SOLICITUD TRAMITE
            $arrayCabeceraTramite =  $data[0];
            return response()->json($arrayCabeceraTramite);

        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function SetTramiteTarjeta(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $arrayDatosVehiculoPlacaByPedido = [];

        try{
            DB::beginTransaction();
            $arrayPedidosChecked = $request->arrayPedidosChecked;
            foreach($arrayPedidosChecked as $ep=>$det)
            {
                $data = DB::select('exec usp_Tramite_SetRegistrarTramiteTarjeta ?, ?, ?, ?, ?, ?',
                                                                    [   $request->nIdCabeceraTramite,
                                                                        $det['nIdCabeceraPedido'],
                                                                        $request->dFechaInicioTramite,
                                                                        $request->dFechaFinTramite,
                                                                        $request->nIdEstadoTramite,
                                                                        Auth::user()->id
                                                                    ]);

                $datosVehiculoPlacaByPedido = DB::select('exec usp_Tramite_GetVehiculoPlacaCompraByPedido ?, ?',
                                                                    [
                                                                        $det['nIdCompra'],
                                                                        Auth::user()->id
                                                                    ]);

                array_push($arrayDatosVehiculoPlacaByPedido, $datosVehiculoPlacaByPedido[0]);
            }
            DB::commit();

            $datosVehiculoPlaca = $this->SetVehiculoPlacaByCommpraPedido($arrayDatosVehiculoPlacaByPedido);
            return response()->json($datosVehiculoPlaca);
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function SetVehiculoPlacaByCommpraPedido($array)
    {
        try{
            DB::beginTransaction();

            foreach($array as $info)
            {
                $data = DB::select('exec usp_Tramite_SetVehiculoPlacaCompraByPedido ?, ?, ?, ?, ?, ?, ?',
                                                                    [
                                                                        $info->nIdCompra,
                                                                        $info->nIdMarca,
                                                                        $info->nIdModelo,
                                                                        $info->nAnioModelo,
                                                                        $info->cNumeroMotor,
                                                                        $info->cNumeroVin,
                                                                        Auth::user()->id
                                                                    ]);
            }
            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function GetSolicitudesTramites(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEstadoTramite       =   $request->nIdEstadoTramite;
        $cnumvin                =   $request->cnumvin;
        $fechaInicioTramite     =   $request->fechaInicioTramite;
        $fechaFinRealTramite    =   $request->fechaFinRealTramite;
        $nIdTramitador          =   Auth::user()->id;

        $nIdEstadoTramite       =   ($nIdEstadoTramite == NULL) ? ($nIdEstadoTramite = 0) : $nIdEstadoTramite;
        $cnumvin                =   ($cnumvin == NULL) ? ($cnumvin = 0) : $cnumvin;
        $fechaInicioTramite     =   ($fechaInicioTramite == NULL) ? ($fechaInicioTramite = '') : $fechaInicioTramite;
        $fechaFinRealTramite    =   ($fechaFinRealTramite == NULL) ? ($fechaFinRealTramite = '') : $fechaFinRealTramite;

        $arraySolicitudesTramites = DB::select('exec usp_Tramite_GetSolicitudesTramites ?, ?, ?, ?, ?',
                                                            [
                                                                $nIdEstadoTramite,
                                                                $cnumvin,
                                                                $nIdTramitador,
                                                                $fechaInicioTramite,
                                                                $fechaFinRealTramite
                                                            ]);

        $arraySolicitudesTramites = Parametro::arrayPaginator($arraySolicitudesTramites, $request);
        return ['arraySolicitudesTramites'=>$arraySolicitudesTramites];
    }

    public function exportSolicitudes(Request $request)
    {
        $nIdEstadoTramite       =   $request->nIdEstadoTramite;
        $cnumvin                =   $request->cnumvin;
        $fechaInicioTramite     =   $request->fechaInicioTramite;
        $fechaFinRealTramite    =   $request->fechaFinRealTramite;
        $nIdTramitador          =   Auth::user()->id;

        $nIdEstadoTramite       =   ($nIdEstadoTramite == NULL) ? ($nIdEstadoTramite = 0) : $nIdEstadoTramite;
        $cnumvin                =   ($cnumvin == NULL) ? ($cnumvin = 0) : $cnumvin;
        $fechaInicioTramite     =   ($fechaInicioTramite == NULL) ? ($fechaInicioTramite = '') : $fechaInicioTramite;
        $fechaFinRealTramite    =   ($fechaFinRealTramite == NULL) ? ($fechaFinRealTramite = '') : $fechaFinRealTramite;

        $arraySolicitudesTramites = DB::select('exec usp_Tramite_GetSolicitudesTramitesReporte ?, ?, ?, ?, ?',
                                                            [
                                                                $nIdEstadoTramite,
                                                                $cnumvin,
                                                                $nIdTramitador,
                                                                $fechaInicioTramite,
                                                                $fechaFinRealTramite
                                                            ]);

        return $arraySolicitudesTramites;
    }

    public function GetDetalleSolicitudTramite(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdCabeceraTramite =   $request->nIdCabeceraTramite;
        $nIdTramitador      =   Auth::user()->id;

        $nIdCabeceraTramite =   ($nIdCabeceraTramite == NULL) ? ($nIdCabeceraTramite = 0) : $nIdCabeceraTramite;

        $arrayDetalleSolicitudTramite = DB::select('exec usp_Tramite_GetDetalleSolicitudTramite ?, ?',
                                                            [
                                                                $nIdCabeceraTramite,
                                                                $nIdTramitador
                                                            ]);

        $arrayDetalleSolicitudTramite = Parametro::arrayPaginator($arrayDetalleSolicitudTramite, $request);
        return ['arrayDetalleSolicitudTramite'=>$arrayDetalleSolicitudTramite];
    }

    public function GetEstadosTarjetasPlaca(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $flagOpcion     =   $request->flagOpcion;
        $nIdTramiteTarjeta = $request->nIdTramiteTarjeta;
        $nIdTramitePlaca = $request->nIdTramitePlaca;
        $nIdTramitador  =   Auth::user()->id;

        $flagOpcion = ($flagOpcion == NULL) ? ($flagOpcion = 0) : $flagOpcion;

        $arrayListadoEstadosTarjetaPlaca = DB::select('exec usp_Tramite_GetEstadosTarjetasPlaca ?, ?, ?, ?',
                                                            [
                                                                $flagOpcion,
                                                                $nIdTramiteTarjeta,
                                                                $nIdTramitePlaca,
                                                                $nIdTramitador
                                                            ]);

        $arrayListadoEstadosTarjetaPlaca = Parametro::arrayPaginator($arrayListadoEstadosTarjetaPlaca, $request);
        return ['arrayListadoEstadosTarjetaPlaca'=>$arrayListadoEstadosTarjetaPlaca];
    }

    public function SetEstadoTramiteTarjeta(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdTramiteTarjeta      =   $request->nIdTramiteTarjeta;
        $dFechaFinRealTramite   =   $request->dFechaFinRealTramite;
        $nIdEstado              =   $request->nIdEstado;
        $cNroTitulo             =   $request->cNroTitulo;
        $cNroPlaca              =   $request->cNroPlaca;
        $cObservacion           =   $request->cObservacion;

        $flagRegTramiteByEstado =   $request->flagRegTramiteByEstado;

        $nIdTramiteTarjeta      =   ($nIdTramiteTarjeta == NULL) ? ($nIdTramiteTarjeta = '') : $nIdTramiteTarjeta;
        $dFechaFinRealTramite   =   ($dFechaFinRealTramite == NULL) ? ($dFechaFinRealTramite = '') : $dFechaFinRealTramite;
        $nIdEstado              =   ($nIdEstado == NULL) ? ($nIdEstado = '') : $nIdEstado;
        $cNroTitulo             =   ($cNroTitulo == NULL) ? ($cNroTitulo = '') : $cNroTitulo;
        $cNroPlaca              =   ($cNroPlaca == NULL) ? ($cNroPlaca = '') : $cNroPlaca;
        $cObservacion           =   ($cObservacion == NULL) ? ($cObservacion = '') : $cObservacion;

        $data = DB::select('exec usp_Tramite_SetTramiteObservacionTarjeta ?, ?, ?, ?, ?, ?, ?, ?',
                                                            [   $nIdTramiteTarjeta,
                                                                $dFechaFinRealTramite,
                                                                $nIdEstado,
                                                                $cNroTitulo,
                                                                $cNroPlaca,
                                                                $cObservacion,
                                                                $flagRegTramiteByEstado,
                                                                Auth::user()->id
                                                            ]);

        //OBTENGO DATA DE LA SOLICITUD TRAMITE
        $arrayDatosTramiteTarjeta =  $data[0];

        return response()->json($arrayDatosTramiteTarjeta);
    }

    public function SetEstadoTramitePlaca(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdTramitePlaca        =   $request->nIdTramitePlaca;
        $nIdCabeceraTramite     =   $request->nIdCabeceraTramite;
        $nIdTramiteTarjeta      =   $request->nIdTramiteTarjeta;
        $dFechaInicioTramite    =   $request->dFechaInicioTramite;
        $dFechaFinTramite       =   $request->dFechaFinTramite;
        $nIdEstado              =   $request->nIdEstado;
        $dFechaFinRealTramite   =   $request->dFechaFinRealTramite;
        $cObservacion           =   $request->cObservacion;
        $flagRegTramiteByEstado =   $request->flagRegTramiteByEstado;

        $nIdTramitePlaca        =   ($nIdTramitePlaca == NULL) ? ($nIdTramitePlaca = '') : $nIdTramitePlaca;
        $nIdCabeceraTramite     =   ($nIdCabeceraTramite == NULL) ? ($nIdCabeceraTramite = '') : $nIdCabeceraTramite;
        $nIdTramiteTarjeta      =   ($nIdTramiteTarjeta == NULL) ? ($nIdTramiteTarjeta = '') : $nIdTramiteTarjeta;
        $dFechaInicioTramite    =   ($dFechaInicioTramite == NULL) ? ($dFechaInicioTramite = '') : $dFechaInicioTramite;
        $dFechaFinTramite       =   ($dFechaFinTramite == NULL) ? ($dFechaFinTramite = '') : $dFechaFinTramite;
        $nIdEstado              =   ($nIdEstado == NULL) ? ($nIdEstado = '') : $nIdEstado;
        $dFechaFinRealTramite   =   ($dFechaFinRealTramite == NULL) ? ($dFechaFinRealTramite = '') : $dFechaFinRealTramite;
        $cObservacion           =   ($cObservacion == NULL) ? ($cObservacion = '') : $cObservacion;

        $data = DB::select('exec usp_Tramite_SetTramiteObservacionPlaca ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                            [
                                                                $nIdTramitePlaca,
                                                                $nIdCabeceraTramite,
                                                                $nIdTramiteTarjeta,
                                                                $dFechaInicioTramite,
                                                                $dFechaFinTramite,
                                                                $nIdEstado,
                                                                $dFechaFinRealTramite,
                                                                $cObservacion,
                                                                $flagRegTramiteByEstado,
                                                                Auth::user()->id
                                                            ]);

        //OBTENGO DATA DE LA SOLICITUD TRAMITE
        $arrayDatosTramitePlaca =  $data[0];

        return response()->json($arrayDatosTramitePlaca);
    }
}
