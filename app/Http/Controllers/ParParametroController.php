<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ParParametroController extends Controller
{
    public function GetParParametro(Request $request)
    {
        $nParSrcCodigo = $request->nparsrccodigo;
        $nParSrcGrupoParametro = $request->nparsrcgrupoarametro;
        $nParDstCodigo = $request->npardstcodigo;
        $nParDtsGrupoParametro = $request->npardstgrupoarametro;
        $variable   = $request->opcion;
        $variable = ($variable == NULL) ? ($variable = 0) : $variable;

        $arrayParParametro = DB::select('exec [usp_ParParametro_GetParParametro] ?, ?, ?, ?', 
                                                                [   $nParSrcCodigo, 
                                                                    $nParSrcGrupoParametro, 
                                                                    $nParDstCodigo,
                                                                    $nParDtsGrupoParametro
                                                                ]);
        if($variable == "0"){
            $arrayParParametro = ParametroController::arrayPaginator($arrayParParametro, $request);
        }
        return ['arrayParParametro'=>$arrayParParametro];
    }

    public function GetListParParametroByGrupoTodos(Request $request)
    {
        $nIdPar = $request->nidpar;
        $nIdGrupoPar = $request->nidgrupopar;
        $nIdSubGrupoPar = $request->nidsubgrupopar;
        $variable   = $request->opcion;

        $variable = ($variable == NULL) ? ($variable = 0) : $variable;

        $arrayParParametro = DB::select('exec [usp_ParParametro_GetListParametroByGrupoTodos] ?, ?, ?', 
                                                                [   $nIdPar, 
                                                                    $nIdGrupoPar,
                                                                    $nIdSubGrupoPar
                                                                ]);
        if($variable == "0"){
            $arrayParParametro = ParametroController::arrayPaginator($arrayParParametro, $request);
        }
        return ['arrayParParametro'=>$arrayParParametro];
    }

    public function SetParParametro(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $parparametro = DB::select('exec [usp_ParParametro_SetParParametro] ?, ?, ?, ?, ?, ?', 
                                                                [   $request->nParSrcCodigo, 
                                                                    $request->nParSrcGrupoParametro, 
                                                                    $request->nParDstCodigo,
                                                                    $request->nParDstGrupoParametro,
                                                                    $request->cValor,
                                                                    Auth::user()->id
                                                                ]);
        return response()->json($parparametro); 
    }

    public function ElmParParametro(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $parparametro = DB::select('exec [usp_ParParametro_ElmParParametro] ?, ?, ?, ?, ?, ?', 
                                                                [   $request->nParSrcCodigo, 
                                                                    $request->nParSrcGrupoParametro, 
                                                                    $request->nParDstCodigo,
                                                                    $request->nParDstGrupoParametro,
                                                                    $request->cValor,
                                                                    Auth::user()->id
                                                                ]);
        return response()->json($parparametro); 
    }
}
