<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ParametroController as Parametro;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TipoInspeccionController extends Controller
{
    public function SetTipoInspeccion(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        $element = DB::select('exec usp_TipoInspeccion_SetTipoInspeccion ?, ?, ?, ?, ?, ?, ?, ?', 
                                                            array($request->nIdEmpresa,
                                                                    $request->cNombreTipoInspeccion    ,
                                                                    $request->nFlagAlmacen, 
                                                                    $request->nFlagAccesorio,
                                                                    $request->nFlagTestDrive,
                                                                    $request->nFlagSeccion,
                                                                    $request->nFlagFichaTecnica,
                                                                    Auth::user()->id
                                                                    ));
        return response()->json($element);         
    }
}
