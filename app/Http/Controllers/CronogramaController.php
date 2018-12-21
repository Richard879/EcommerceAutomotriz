<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CronogramaController extends Controller
{
    public function GetCronogramaVentaActivo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;

        $arrayCronograma = DB::select('exec [usp_Cronog_GetVentaActivo] ?',
                                                        [   $nIdEmpresa
                                                        ]);
        return ['arrayCronograma'=>$arrayCronograma];
    }
    
    public function GetCronogramaCompraActivo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;

        $arrayCronograma = DB::select('exec [usp_Cronog_GetCompraActivo] ?',
                                                        [   $nIdEmpresa
                                                        ]);
        return ['arrayCronograma'=>$arrayCronograma];
    }

    public function GetCronogramaActivoByTipo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdGrupoPar = $request->nidgrupopar;
        $nIdPar = $request->nidpar;

        $arrayCronograma = DB::select('exec [usp_Cronog_GetCronogramaActivoByTipo] ?, ?, ?',
                                                        [   $nIdEmpresa,
                                                            $nIdGrupoPar,
                                                            $nIdPar
                                                        ]);
        return ['arrayCronograma'=>$arrayCronograma];
    }

    public function SetActivarCronograma(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        $objCronograma = DB::select('exec [usp_Cronograma_SetActivarCronograma] ?, ?, ? ,?, ?', 
                                                            [   $request->nIdEmpresa,
                                                                $request->nIdTipoCronograma,
                                                                $request->nIdAnio, 
                                                                $request->nIdMes,
                                                                Auth::user()->id
                                                            ]);
        return response()->json($objCronograma);         
    }
}
