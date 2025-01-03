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
        $nombreArchivoServidor = $bandera .'_'. $file->getClientOriginalName();

        $ruta = Storage::putFileAs('public/Depositos', $file, $nombreArchivoServidor);

        $arrayDocumento = DB::select('exec usp_DocumentoAdjunto_SetArchivo ?, ?, ?',
                                                        [
                                                            asset('storage/Depositos/' . $nombreArchivoServidor),
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

        $arrayPedido = DB::select('exec usp_Deposito_SetDeposito ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
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
                                        $request->cFlagFormaPagoFinanciado,
                                        $request->nIdFormaPagoFinanciado,
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
        $cContacto          =   $request->ccontacto;
        $cNumeroDocumento   =   $request->cnrodocumento;

        $dFechaInicio       = ($dFechaInicio == NULL) ? ($dFechaInicio = '') : $dFechaInicio;
        $dFechaFin          = ($dFechaFin == NULL) ? ($dFechaFin = '') : $dFechaFin;
        $cNumeroPedido      = ($cNumeroPedido == NULL) ? ($cNumeroPedido = '') : $cNumeroPedido;
        $cNumeroVin         = ($cNumeroVin == NULL) ? ($cNumeroVin = '') : $cNumeroVin;
        $nIdMarca           = ($nIdMarca == NULL) ? ($nIdMarca = 0) : $nIdMarca;
        $nIdModelo          = ($nIdModelo == NULL) ? ($nIdModelo = 0) : $nIdModelo;
        $nIdEstadoPedido    = ($nIdEstadoPedido == NULL) ? ($nIdEstadoPedido = 0) : $nIdEstadoPedido;
        $cContacto          = ($cContacto == NULL) ? ($cContacto = '') : $cContacto;
        $cNumeroDocumento   = ($cNumeroDocumento == NULL) ? ($cNumeroDocumento = '') : $cNumeroDocumento;

        $arrayPedido = DB::select('exec [usp_Deposito_GetListPedidoConDeposito] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                                        [   $nIdEmpresa,
                                                                            $nIdSucursal,
                                                                            $dFechaInicio,
                                                                            $dFechaFin,
                                                                            $cNumeroPedido,
                                                                            $cNumeroVin,
                                                                            $nIdMarca,
                                                                            $nIdModelo,
                                                                            $nIdEstadoPedido,
                                                                            $cContacto,
                                                                            $cNumeroDocumento,
                                                                            Auth::user()->id
                                                                        ]);

        //$arrayPedido = ParametroController::arrayPaginator($arrayPedido, $request);
        return ['arrayPedido'=>$arrayPedido];
    }

    public function GetListDepositosPorPedido(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa         =   $request->nIdEmpresa;
        $nIdCabeceraPedido  =   $request->nIdCabeceraPedido;
        $cEstadoDeposito    =   $request->cEstadoDeposito;

        $cEstadoDeposito    =   ($cEstadoDeposito == NULL) ? ($cEstadoDeposito = '') : $cEstadoDeposito;

        $arrayDepositosPorPedido = DB::select('exec usp_Deposito_GetListDepositosPorPedido ?, ?, ?, ?',
                                    [
                                        $nIdEmpresa,
                                        $nIdCabeceraPedido,
                                        $cEstadoDeposito,
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

    public function SetCambiarEstadoDepositoFinanciamiento(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdDepositoPedido      =   $request->nIdDepositoPedido;
        $nIdCabeceraPedido      =   $request->nIdCabeceraPedido;
        $cFlagEstadoDeposito    =   $request->cFlagEstadoDeposito;
        $nIdMonedaOrigen        =   $request->nIdMonedaOrigen;
        $fTipoCambio            =   $request->fTipoCambio;
        //ADDON
        $CardCode               =   $request->CardCode;
        $CardName               =   $request->CardName;
        $Type                   =   $request->Type;
        // $nIdTipoPago        =   $request->nIdTipoPago;//Tipo Financiado
        $TransRef               =   $request->TransRef;
        $DocDate                =   $request->DocDate;
        $DocTotal               =   $request->DocTotal;
        $DocTotalFC             =   $request->DocTotalFC;
        $DocCurr                =   $request->DocCurr;
        $DocCurrBank            =   $request->DocCurrBank;
        $Account                =   $request->cAcctCode;
        $FacturaDocTotal        =   $request->FacturaDocTotal;
        $FacturaDocTotalFC      =   $request->FacturaDocTotalFC;
        $DocRate                =   $request->DocRate;
        $DocNum                 =   $request->DocNum;
        $nIdFormaPago           =   $request->nIdFormaPago;
        $Migrado                =   $request->Migrado;

        $DocNum                 =   ($DocNum == NULL) ? ($DocNum = '') : $DocNum;
        $nIdFormaPago           =   ($nIdFormaPago == NULL) ? ($nIdFormaPago = 0) : $nIdFormaPago;

        $arrayDepositosPorPedido = DB::select('exec usp_Deposito_SetCambiarEstadoDepositoAddonFinanciado ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
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
                                        $DocNum,
                                        $nIdFormaPago,
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

    public function SetCambiarEstadoDepositoPreliminar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdCabeceraPedido      =   $request->nIdCabeceraPedido;
        $nIdDepositoPedido      =   $request->nIdDepositoPedido;
        $cFlagEstadoDeposito    =   $request->cFlagEstadoDeposito;

        $arrayDepositosPorPedido = DB::select('exec usp_Deposito_SetCambiarEstadoDepositoPreliminar ?, ?, ?, ?',
                                    [
                                        $nIdCabeceraPedido,
                                        $nIdDepositoPedido,
                                        $cFlagEstadoDeposito,
                                        Auth::user()->id
                                    ]);
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
        $cNumeroDocumento   =   $request->cnrodocumento;
        $ntipopersona       =   $request->ntipopersona;

        $dFechaInicio       =   ($dFechaInicio == NULL) ? ($dFechaInicio = '') : $dFechaInicio;
        $dFechaFin          =   ($dFechaFin == NULL) ? ($dFechaFin = '') : $dFechaFin;
        $cNumeroPedido      =   ($cNumeroPedido == NULL) ? ($cNumeroPedido = '') : $cNumeroPedido;
        $cNumeroVin         =   ($cNumeroVin == NULL) ? ($cNumeroVin = '') : $cNumeroVin;
        $nIdMarca           =   ($nIdMarca == NULL) ? ($nIdMarca = 0) : $nIdMarca;
        $nIdModelo          =   ($nIdModelo == NULL) ? ($nIdModelo = 0) : $nIdModelo;
        $nIdEstadoPedido    =   ($nIdEstadoPedido == NULL) ? ($nIdEstadoPedido = 0) : $nIdEstadoPedido;
        $cContacto          =   ($cContacto == NULL) ? ($cContacto = '') : $cContacto;
        $cNumeroDocumento   =   ($cNumeroDocumento == NULL) ? ($cNumeroDocumento = '') : $cNumeroDocumento;
        $ntipopersona       =   ($ntipopersona == NULL) ? ($ntipopersona = 1) : $ntipopersona;

        $arrayPedido = DB::select('exec [usp_Deposito_GetListPedidoAprobados] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                                        [   $nIdEmpresa,
                                                                            $nIdSucursal,
                                                                            $dFechaInicio,
                                                                            $dFechaFin,
                                                                            $cNumeroPedido,
                                                                            $cNumeroVin,
                                                                            $nIdMarca,
                                                                            $nIdModelo,
                                                                            $nIdEstadoPedido,
                                                                            $cContacto,
                                                                            $cNumeroDocumento,
                                                                            $ntipopersona,
                                                                            Auth::user()->id
                                                                        ]);

        $arrayPedido = ParametroController::arrayPaginator($arrayPedido, $request);
        return ['arrayPedido'=>$arrayPedido];
    }

    public function GetDetalleDeposito(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa         =   $request->nIdEmpresa;
        $nIdSucursal        =   $request->nIdSucursal;
        $nIdCabeceraPedido  =   $request->nIdCabeceraPedido;
        $fMontoPedido       =   $request->fMontoPedido;
        $fMontoDepositado   =   $request->fMontoDepositado;
        $fMontoCancelado    =   $request->fMontoCancelado;

        $fMontoPedido       =   ($fMontoPedido == NULL) ? ($fMontoPedido = 0) : $fMontoPedido;
        $fMontoDepositado   =   ($fMontoDepositado == NULL) ? ($fMontoDepositado = 0) : $fMontoDepositado;
        $fMontoCancelado    =   ($fMontoCancelado == NULL) ? ($fMontoCancelado = 0) : $fMontoCancelado;

        if ($nIdEmpresa == 1300011) {
            $img_empresa    =   public_path('img/automotoresinka.png');//CAPTURO LA RUTA DEL LOGO
            $img_marca      =   public_path('img/hyundai.png');//CAPTURO LA RUTA DE HYUNDAI
        } else {
            $img_empresa    =   public_path('img/inkalider.jpg');//CAPTURO LA RUTA DEL LOGO
            $img_marca      =   public_path('img/nissan.jpg');//CAPTURO LA RUTA DE HYUNDAI
        }

        $arrayDepositosPorPedido = DB::select('exec usp_Deposito_GetListDepositosPorPedido ?, ?, ?, ?',
                                    [
                                        $nIdEmpresa,
                                        $nIdCabeceraPedido,
                                        '',
                                        Auth::user()->id
                                    ]);

        $pdf = \PDF::loadView('pdf.pedido.pedidodeposito', [
                                                        'img_empresa'               =>  $img_empresa,
                                                        'img_marca'                 =>  $img_marca,
                                                        'arrayDepositosPorPedido'   =>  $arrayDepositosPorPedido,
                                                        'fMontoPedido'              =>  $fMontoPedido,
                                                        'fMontoDepositado'          =>  $fMontoDepositado,
                                                        'fMontoCancelado'           =>  $fMontoCancelado
                                                    ]);

        return $pdf->download('Pedido Deposito -'.$nIdCabeceraPedido.'.pdf');
    }
}
