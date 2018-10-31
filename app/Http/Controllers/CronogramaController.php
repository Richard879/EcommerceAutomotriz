<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

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
}
