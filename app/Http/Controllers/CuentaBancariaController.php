<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CuentaBancariaController extends Controller
{
    public function GetBancosByEmpresa(Request $request)
    {      
        $nIdEmpresa = $request->nidempresa;
        $variable   = $request->opcion;

        $variable = ($variable == NULL) ? ($variable = 0) : $variable;

        $arrayCuentaBancaria = DB::select('exec [usp_CuentaBancaria_GetBancosByEmpresa] ?',
                                                            [   $nIdEmpresa
                                                            ]);
        if($variable == "0"){
            $arrayCuentaBancaria = ParametroController::arrayPaginator($arrayCuentaBancaria, $request);
        }
        return ['arrayCuentaBancaria'=>$arrayCuentaBancaria];
    }
}
