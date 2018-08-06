<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Parametro;

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

    public function arrayPaginator($array, $request)
    {
        $page = $request->page;
        $perPage = 10;
        $offset = ($page * $perPage) - $perPage;

        $array = new Collection($array);
        $result = $array->forPage($page, $perPage)->values()->all();
        return  new LengthAwarePaginator($result, $array->count(), $perPage,$page);
    }
}
