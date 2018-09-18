<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GrupoParametroController extends Controller
{
    public function GetGrupoParametroEventoCampania(Request $request)
    {
        //$nIdGrupoPar = $request->ngrupoparid;
        $variable   = $request->opcion;

        $grupopar = DB::select('exec usp_GrupoPar_GetGruposEventoCampania');
        $data = [];
        if($variable == "0"){
            $data[0] = [
                'nIdGrupoPar'   => 0,
                'cGrupoParNombre' =>'SELECCIONE',
            ];
        }
        foreach ($grupopar as $key => $value) {
           $data[$key+1] =[
                'nIdGrupoPar'   => $value->nIdGrupoPar,
                'cGrupoParNombre' => $value->cGrupoParNombre,
            ];
        }
        return response()->json($data);
    }

}
