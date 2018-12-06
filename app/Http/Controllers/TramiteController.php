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
        $nIdTramitador      = Auth::user()->id;

        $nIdEstadoTramite = ($nIdEstadoTramite == NULL) ? ($nIdEstadoTramite = 0) : $nIdEstadoTramite;

        $arrayPedidosCancelados = DB::select('exec usp_Tramite_GetPedidosCanceladosByEstadoTramite ?, ?',
                                                            [
                                                                $nIdEstadoTramite,
                                                                $nIdTramitador
                                                            ]);

        $arrayPedidosCancelados = Parametro::arrayPaginator($arrayPedidosCancelados, $request);
        return ['arrayPedidosCancelados'=>$arrayPedidosCancelados];
    }

    public function SetCabeceraTramite(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $data = DB::select('exec usp_Tramite_SetRegistrarTramite ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                                [   $request->nIdEmpresa,
                                                                    $request->nIdSucursal,
                                                                    $request->dFechaInicioTramite,
                                                                    $request->dFechaFinTramite,
                                                                    $request->nNroVehiculoTramite,
                                                                    $request->fTotalConTramiteTarjeta,
                                                                    $request->fTotalConTramitePlaca,
                                                                    $request->fTotalGastoAdicional,
                                                                    $request->fTotalTramite,
                                                                    $request->nIdEstadoTramite,
                                                                    $request->cFlagEstadoAprobacion,
                                                                    Auth::user()->id
                                                                ]);

        //OBTENGO DATA DE LA SOLICITUD TRAMITE
        $arrayCabeceraTramite =  $data[0];

        return response()->json($arrayCabeceraTramite);
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
                                                                        $info->nAnioFabricacion,
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

        $nIdEstadoTramite   = $request->nIdEstadoTramite;
        $fechaInicioTramite   = $request->fechaInicioTramite;
        $fechaFinRealTramite   = $request->fechaFinRealTramite;
        $nIdTramitador      = Auth::user()->id;

        $nIdEstadoTramite = ($nIdEstadoTramite == NULL) ? ($nIdEstadoTramite = 0) : $nIdEstadoTramite;
        $fechaInicioTramite = ($fechaInicioTramite == NULL) ? ($fechaInicioTramite = '') : $fechaInicioTramite;
        $fechaFinRealTramite = ($fechaFinRealTramite == NULL) ? ($fechaFinRealTramite = '') : $fechaFinRealTramite;

        $arraySolicitudesTramites = DB::select('exec usp_Tramite_GetSolicitudesTramites ?, ?, ?, ?',
                                                            [
                                                                $nIdEstadoTramite,
                                                                $nIdTramitador,
                                                                $fechaInicioTramite,
                                                                $fechaFinRealTramite
                                                            ]);

        $arraySolicitudesTramites = Parametro::arrayPaginator($arraySolicitudesTramites, $request);
        return ['arraySolicitudesTramites'=>$arraySolicitudesTramites];
    }

    public function GetDetalleSolicitudTramite(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdCabeceraTramite   = $request->nIdCabeceraTramite;
        $nIdTramitador      = Auth::user()->id;

        $nIdCabeceraTramite = ($nIdCabeceraTramite == NULL) ? ($nIdCabeceraTramite = 0) : $nIdCabeceraTramite;

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
        $cNroTarjeta            =   $request->cNroTarjeta;
        $cNroPlaca              =   $request->cNroPlaca;
        $cObservacion           =   $request->cObservacion;

        $flagRegTramiteByEstado =   $request->flagRegTramiteByEstado;

        $nIdTramiteTarjeta      =   ($nIdTramiteTarjeta == NULL) ? ($nIdTramiteTarjeta = '') : $nIdTramiteTarjeta;
        $dFechaFinRealTramite   =   ($dFechaFinRealTramite == NULL) ? ($dFechaFinRealTramite = '') : $dFechaFinRealTramite;
        $nIdEstado              =   ($nIdEstado == NULL) ? ($nIdEstado = '') : $nIdEstado;
        $cNroTarjeta            =   ($cNroTarjeta == NULL) ? ($cNroTarjeta = '') : $cNroTarjeta;
        $cNroPlaca              =   ($cNroPlaca == NULL) ? ($cNroPlaca = '') : $cNroPlaca;
        $cObservacion           =   ($cObservacion == NULL) ? ($cObservacion = '') : $cObservacion;

        $data = DB::select('exec usp_Tramite_SetTramiteObservacionTarjeta ?, ?, ?, ?, ?, ?, ?, ?',
                                                            [   $nIdTramiteTarjeta,
                                                                $dFechaFinRealTramite,
                                                                $nIdEstado,
                                                                $cNroTarjeta,
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

        $nIdTramitePlaca = $request->nIdTramitePlaca;
        $nIdCabeceraTramite = $request->nIdCabeceraTramite;
        $nIdTramiteTarjeta = $request->nIdTramiteTarjeta;
        $dFechaInicioTramite = $request->dFechaInicioTramite;
        $dFechaFinTramite = $request->dFechaFinTramite;
        $nIdEstado = $request->nIdEstado;
        $dFechaFinRealTramite = $request->dFechaFinRealTramite;
        $cObservacion = $request->cObservacion;
        $flagRegTramiteByEstado = $request->flagRegTramiteByEstado;

        $nIdTramitePlaca = ($nIdTramitePlaca == NULL) ?
                                    ($nIdTramitePlaca = '') : $nIdTramitePlaca;
        $nIdCabeceraTramite = ($nIdCabeceraTramite == NULL) ?
                                    ($nIdCabeceraTramite = '') : $nIdCabeceraTramite;
        $nIdTramiteTarjeta = ($nIdTramiteTarjeta == NULL) ?
                                    ($nIdTramiteTarjeta = '') : $nIdTramiteTarjeta;
        $dFechaInicioTramite = ($dFechaInicioTramite == NULL) ?
                                    ($dFechaInicioTramite = '') : $dFechaInicioTramite;
        $dFechaFinTramite = ($dFechaFinTramite == NULL) ?
                                    ($dFechaFinTramite = '') : $dFechaFinTramite;
        $nIdEstado = ($nIdEstado == NULL) ? ($nIdEstado = '') : $nIdEstado;
        $dFechaFinRealTramite = ($dFechaFinRealTramite == NULL) ?
                                     ($dFechaFinRealTramite = '') : $dFechaFinRealTramite;

        $cObservacion = ($cObservacion == NULL) ? ($cObservacion = '') : $cObservacion;

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
