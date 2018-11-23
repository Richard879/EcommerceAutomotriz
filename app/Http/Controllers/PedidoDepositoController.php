<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PedidoDepositoController extends Controller
{
    public function GetNumeroCuentaByBancoAndMoneda(Request $request)
    {
        $nIdEmpresa = $request->nidempresa;
        $nIdBanco = $request->nidbanco;
        $nIdMoneda = $request->nidmoneda;
        $variable   = $request->opcion;

        $cuentabancaria = DB::select('exec usp_Deposito_GetNumeroCuentaByBancoAndMoneda ?, ?, ?', [$nIdEmpresa, $nIdBanco, $nIdMoneda]);

        $data = [];
        if($variable == "0"){
            $data[0] = [
                'nIdCuenta'   => 0,
                'cNumeroCuenta' =>'SELECCIONE',
            ];
        }
        foreach ($cuentabancaria as $key => $value) {
           $data[$key+1] =[
                'nIdCuenta'   => $value->nIdCuenta,
                'cNumeroCuenta' => $value->cNumeroCuenta,
            ];
        }
        return response()->json($data);
    }

    public function GetParDsctByParSrc(Request $request)
    {
        $nidtipopago = $request->nidtipopago;

        $parparametro = DB::select('exec [usp_ParParametro_GetParDsctByParSrc] ?',
                                                                        [   $nidtipopago
                                                                        ]);
        return response()->json($parparametro);
    }

    public function subirArchivo(Request $request)
    {
        $file = $request->file;
        $bandera = str_random(10);

        $ruta = Storage::putFileAs('uploads/Depositos', $file, $bandera .'_'. $file->getClientOriginalName());

        $arrayDocumento = DB::select('exec usp_DocumentoAdjunto_SetArchivo ?, ?, ?',
                                                        [  asset($ruta),
                                                            $file->getClientOriginalName(),
                                                            Auth::user()->id
                                                        ]);

        return response()->json($arrayDocumento);
    }

    public function SetDepositoPedido(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $arrayPedido = DB::select('exec usp_Deposito_SetDeposito ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                    [
                                        $request->nIdEmpresa,
                                        $request->nIdSucursal,
                                        $request->nIdCabeceraPedido,
                                        $request->nIdTipoMovimiento,
                                        $request->nIdDocumentoAdjuntoVoucher,
                                        $request->nIdBancoOrigen,
                                        $request->nIdMonedaOrigen,
                                        $request->cNumeroCuentaOrigen,
                                        $request->nIdCuentaBancariaEmpresa,
                                        $request->dFechaDeposito,
                                        $request->nNumeroOperacion,
                                        $request->fTipoCambioDeposito,
                                        $request->fTipoCambioComercial,
                                        $request->fMonto,
                                        $request->cGlosa,
                                        $request->cFlagTipoCambioEspecial,
                                        Auth::user()->id
                                    ]);

        return response()->json($arrayPedido);
    }

    public function GetMontoTotalDepositos(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa         =   $request->nidempresa;
        $nIdSucursal        =   $request->nidsucursal;
        $nIdCabeceraPedido  =   $request->nIdCabeceraPedido;
        $cFlagEstadoAprobacion  =   $request->cFlagEstadoAprobacion;

        $nIdCabeceraPedido = ($nIdCabeceraPedido == NULL) ? ($nIdCabeceraPedido = 0) : $nIdCabeceraPedido;

        $arrayMontoTotalDepositos = DB::select('exec usp_Deposito_GetMontoTotalDepositos ?, ?, ?, ?, ?',
                                    [
                                        $nIdEmpresa,
                                        $nIdSucursal,
                                        $nIdCabeceraPedido,
                                        $cFlagEstadoAprobacion,
                                        Auth::user()->id
                                    ]);

        return response()->json($arrayMontoTotalDepositos);
    }

    public function GetListPedidoConDeposito(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa         =   $request->nidempresa;
        $nIdSucursal        =   $request->nidsucursal;
        $dFechaInicio       =   $request->dfechainicio;
        $dFechaFin          =   $request->dfechafin;
        $cNumeroPedido      =   $request->cnumeropedido;
        $cNumeroVin         =   $request->cnumerovin;
        $nIdMarca           =   $request->nidmarca;
        $nIdModelo          =   $request->nidmodelo;
        $nIdEstadoPedido    =   $request->nidestadopedido;

        $dFechaInicio = ($dFechaInicio == NULL) ? ($dFechaInicio = '') : $dFechaInicio;
        $dFechaFin = ($dFechaFin == NULL) ? ($dFechaFin = '') : $dFechaFin;
        $cNumeroPedido = ($cNumeroPedido == NULL) ? ($cNumeroPedido = '') : $cNumeroPedido;
        $cNumeroVin = ($cNumeroVin == NULL) ? ($cNumeroVin = '') : $cNumeroVin;
        $nIdMarca = ($nIdMarca == NULL) ? ($nIdMarca = 0) : $nIdMarca;
        $nIdModelo = ($nIdModelo == NULL) ? ($nIdModelo = 0) : $nIdModelo;
        $nIdEstadoPedido = ($nIdEstadoPedido == NULL) ? ($nIdEstadoPedido = 0) : $nIdEstadoPedido;

        $arrayPedido = DB::select('exec usp_Deposito_GetListPedidoConDeposito ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                    [
                                        $nIdEmpresa,
                                        $nIdSucursal,
                                        $dFechaInicio,
                                        $dFechaFin,
                                        $cNumeroPedido,
                                        $cNumeroVin,
                                        $nIdMarca,
                                        $nIdModelo,
                                        $nIdEstadoPedido,
                                        Auth::user()->id
                                    ]);

        $arrayPedido = ParametroController::arrayPaginator($arrayPedido, $request);
        return ['arrayPedido'=>$arrayPedido];
    }

    public function GetListDepositosPorPedido(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdCabeceraPedido   =   $request->nIdCabeceraPedido;

        $arrayDepositosPorPedido = DB::select('exec usp_Deposito_GetListDepositosPorPedido ?, ?',
                                    [
                                        $nIdCabeceraPedido,
                                        Auth::user()->id
                                    ]);

        return response()->json($arrayDepositosPorPedido);
    }

    public function SetCambiarEstadoDeposito(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdDepositoPedido   =   $request->nIdDepositoPedido;
        $nIdCabeceraPedido   =   $request->nIdCabeceraPedido;
        $cFlagEstadoDeposito =   $request->cFlagEstadoDeposito;
        $nIdMonedaOrigen     =   $request->nIdMonedaOrigen;
        $fTipoCambio         =   $request->fTipoCambio;

        $arrayDepositosPorPedido = DB::select('exec usp_Deposito_SetCambiarEstadoDeposito ?, ?, ?, ?, ?, ?',
                                    [
                                        $nIdDepositoPedido,
                                        $nIdCabeceraPedido,
                                        $cFlagEstadoDeposito,
                                        $nIdMonedaOrigen,
                                        $fTipoCambio,
                                        Auth::user()->id
                                    ]);

        return response()->json($arrayDepositosPorPedido);
    }

    public function SetCambiarEstadoPedido(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdCabeceraPedido   =   $request->nIdCabeceraPedido;
        $cFlagEstadoPedido   =   $request->cFlagEstadoPedido;
        $nIdEstadoPedido     =   $request->nIdEstadoPedido;

        $arrayDepositosPorPedido = DB::select('exec usp_Deposito_SetCambiarEstadoPedido ?, ?, ?, ?',
                                    [
                                        $nIdCabeceraPedido,
                                        $cFlagEstadoPedido,
                                        $nIdEstadoPedido,
                                        Auth::user()->id
                                    ]);

        return response()->json($arrayDepositosPorPedido);
    }

    public function SetCambiarMontosDepositoByTCE(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdDepositoPedido         =   $request->nIdDepositoPedido;
        $fMontoResultanteDolares   =   $request->fMontoResultanteDolares;
        $fMontoResultanteSoles     =   $request->fMontoResultanteSoles;

        $arrayDepositosPorPedido = DB::select('exec usp_Deposito_SetCambiarMontosDepositoByTCE ?, ?, ?, ?',
                                    [
                                        $nIdDepositoPedido,
                                        $fMontoResultanteDolares,
                                        $fMontoResultanteSoles,
                                        Auth::user()->id
                                    ]);

        return response()->json($arrayDepositosPorPedido);
    }
}
