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
        $nIdBanco   = $request->nidbanco;
        $nIdMoneda  = $request->nidmoneda;
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

        $nIdTipoPago            = $request->nIdTipoPago;
        $nIdFormaPago           = $request->nIdFormaPago;
        $nIdFormaPago2          = $request->nIdFormaPago2;
        $fTipoCambioEspecial    = $request->fTipoCambioEspecial;

        $nIdTipoPago            = ($nIdTipoPago == NULL) ? ($nIdTipoPago = 0) : $nIdTipoPago;
        $nIdFormaPago           = ($nIdFormaPago == NULL) ? ($nIdFormaPago = 0) : $nIdFormaPago;
        $nIdFormaPago2          = ($nIdFormaPago2 == NULL) ? ($nIdFormaPago2 = 0) : $nIdFormaPago2;
        $fTipoCambioEspecial    = ($fTipoCambioEspecial == NULL) ? ($fTipoCambioEspecial = 0) : $fTipoCambioEspecial;

        $arrayPedido = DB::select('exec usp_Deposito_SetDeposito ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                    [
                                        $request->nIdEmpresa,
                                        $request->nIdSucursal,
                                        $request->nIdCabeceraPedido,
                                        $nIdTipoPago,
                                        $nIdFormaPago,
                                        $nIdFormaPago2,
                                        $request->nIdDocumentoAdjuntoVoucher,
                                        $request->nIdBancoOrigen,
                                        $request->nIdMonedaOrigen,
                                        $request->cNumeroCuentaOrigen,
                                        $request->nIdCuentaBancariaEmpresa,
                                        $request->dFechaDeposito,
                                        $request->nNumeroOperacion,
                                        $request->fTipoCambioSUNAT,
                                        $request->fTipoCambioComercial,
                                        $fTipoCambioEspecial,
                                        $request->fMonto,
                                        $request->cTipoComprobante,
                                        $request->cGlosa,
                                        $request->cFlagTipoCambioEspecial,
                                        $request->fTipoCambio,
                                        Auth::user()->id
                                    ]);

        return response()->json($arrayPedido);
    }

    public function GetMontoTotalDepositos(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa             =   $request->nidempresa;
        $nIdSucursal            =   $request->nidsucursal;
        $nIdCabeceraPedido      =   $request->nIdCabeceraPedido;
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

        // return $request;

        $nIdDepositoPedido   =   $request->nIdDepositoPedido;
        $nIdCabeceraPedido   =   $request->nIdCabeceraPedido;
        $cFlagEstadoDeposito =   $request->cFlagEstadoDeposito;
        $nIdMonedaOrigen     =   $request->nIdMonedaOrigen;
        $fTipoCambio         =   $request->fTipoCambio;
        //ADDON
        $CardCode           =   $request->CardCode;
        $CardName           =   $request->CardName;
        $Type               =   $request->Type;
        // $nIdTipoPago        =   $request->nIdTipoPago;//Tipo Financiado
        $TransRef           =   $request->TransRef;
        $DocDate            =   $request->DocDate;
        $DocTotal           =   $request->DocTotal;
        $DocTotalFC         =   $request->DocTotalFC;
        $DocCurr            =   $request->DocCurr;
        $DocCurrBank        =   $request->DocCurrBank;
        $Account            =   $request->cAcctCode;
        $FacturaDocTotal    =   $request->FacturaDocTotal;
        $FacturaDocTotalFC  =   $request->FacturaDocTotalFC;
        $DocRate            =   $request->DocRate;
        $Migrado            =   $request->Migrado;

        //Verificar si el Tipo de Movimiento es Leasing
        if ($Type == '1300457') {
            # Setear a Tipo 2 para Addon
            $Type = 2;
        }

        $arrayDepositosPorPedido = DB::select('exec usp_Deposito_SetCambiarEstadoDepositoAddon ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                    [
                                        $nIdDepositoPedido,
                                        $nIdCabeceraPedido,
                                        $cFlagEstadoDeposito,
                                        $nIdMonedaOrigen,
                                        $fTipoCambio,
                                        //ADDON
                                        $CardCode,
                                        $CardName,
                                        $Type,
                                        $TransRef,
                                        $DocDate,
                                        $DocTotal,
                                        $DocTotalFC,
                                        $DocCurr,
                                        $DocCurrBank,
                                        $Account,
                                        $FacturaDocTotal,
                                        $FacturaDocTotalFC,
                                        $DocRate,
                                        $Migrado,
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

    public function SetCambiarEstadoIncidencia(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdCabeceraPedido          =   $request->nIdCabeceraPedido;
        $nIdDepositoPedido          =   $request->nIdDepositoPedido;
        $cFlagEstadoAlerta          =   $request->cFlagEstadoAlerta;
        $cComentario                =   $request->cComentario;

        $arrayDepositosPorPedido = DB::select('exec usp_Deposito_SetCambiarEstadoIncidencia ?, ?, ?, ?, ?',
                                    [
                                        $nIdCabeceraPedido,
                                        $nIdDepositoPedido,
                                        $cFlagEstadoAlerta,
                                        $cComentario,
                                        Auth::user()->id
                                    ]);

        return response()->json($arrayDepositosPorPedido);
    }

    public function GetListPedidoAprobados(Request $request)
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
        $cContacto          =   $request->ccontacto;
        $ntipopersona       =   $request->ntipopersona;

        $dFechaInicio       =   ($dFechaInicio == NULL) ? ($dFechaInicio = '') : $dFechaInicio;
        $dFechaFin          =   ($dFechaFin == NULL) ? ($dFechaFin = '') : $dFechaFin;
        $cNumeroPedido      =   ($cNumeroPedido == NULL) ? ($cNumeroPedido = '') : $cNumeroPedido;
        $cNumeroVin         =   ($cNumeroVin == NULL) ? ($cNumeroVin = '') : $cNumeroVin;
        $nIdMarca           =   ($nIdMarca == NULL) ? ($nIdMarca = 0) : $nIdMarca;
        $nIdModelo          =   ($nIdModelo == NULL) ? ($nIdModelo = 0) : $nIdModelo;
        $nIdEstadoPedido    =   ($nIdEstadoPedido == NULL) ? ($nIdEstadoPedido = 0) : $nIdEstadoPedido;
        $cContacto          =   ($cContacto == NULL) ? ($cContacto = '') : $cContacto;
        $ntipopersona       =   ($ntipopersona == NULL) ? ($ntipopersona = 1) : $ntipopersona;

        $arrayPedido = DB::select('exec [usp_Deposito_GetListPedidoAprobados] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
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
                                                                            $cContacto,
                                                                            $ntipopersona,
                                                                            Auth::user()->id
                                                                        ]);

        $arrayPedido = ParametroController::arrayPaginator($arrayPedido, $request);
        return ['arrayPedido'=>$arrayPedido];
    }
}
