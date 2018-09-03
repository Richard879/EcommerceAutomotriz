<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class DepositoPedidoController extends Controller
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
}
