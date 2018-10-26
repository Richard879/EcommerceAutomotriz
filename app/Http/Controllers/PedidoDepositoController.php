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

        $arrayPedido = DB::select('exec usp_Deposito_SetDeposito ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
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
}
