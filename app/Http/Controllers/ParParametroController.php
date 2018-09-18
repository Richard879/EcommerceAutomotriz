<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParParametroController extends Controller
{
    public function GetBancosByEmpresa(Request $request)
    {
        $nIdEmpresa = $request->nidempresa;
        $nIdGrupoPar = $request->nidgrupopar;
        $variable   = $request->opcion;

        $parparametro = DB::select('exec usp_ParParametro_GetBancosByEmpresa ?, ?', [$nIdEmpresa, $nIdGrupoPar]);
        $data = [];
        if($variable == "0"){
            $data[0] = [
                'nIdPar'   => 0,
                'cParNombre' =>'SELECCIONE',
            ];
        }
        foreach ($parparametro as $key => $value) {
           $data[$key+1] =[
                'nIdPar'   => $value->nIdPar,
                'cParNombre' => $value->cParNombre,
            ];
        }
        return response()->json($data);
    }

    public function GetParParametro(Request $request)
    {
        $nParSrcCodigo = $request->nparsrccodigo;
        $nParSrcGrupoParametro = $request->nparsrcgrupoarametro;
        $nParDstCodigo = $request->npardstcodigo;
        $variable   = $request->opcion;

        $parparametro = DB::select('exec usp_ParParametro_GetParParametro ?, ?, ?', [$nParSrcCodigo, $nParSrcGrupoParametro, $nParDstCodigo]);
        $data = [];
        if($variable == "0"){
            $data[0] = [
                'nIdPar'   => 0,
                'cParNombre' =>'SELECCIONE',
            ];
        }
        foreach ($parparametro as $key => $value) {
           $data[$key+1] =[
                'nIdPar'   => $value->nIdPar,
                'cParNombre' => $value->cParNombre,
            ];
        }
        return response()->json($data);
    }

}
