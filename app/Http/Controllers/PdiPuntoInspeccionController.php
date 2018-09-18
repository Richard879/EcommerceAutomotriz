<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PdiPuntoInspeccionController extends Controller
{
    public function SetTipoInspeccion(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        $element = DB::select('exec usp_TipoInspeccion_SetTipoInspeccion ?, ?, ?, ?, ?, ?, ?, ?', 
                                                            array($request->nIdEmpresa,
                                                                    $request->cNombreTipoInspeccion,
                                                                    $request->nFlagAlmacen, 
                                                                    $request->nFlagAccesorio,
                                                                    $request->nFlagTestDrive,
                                                                    $request->nFlagSeccion,
                                                                    $request->nFlagFichaTecnica,
                                                                    Auth::user()->id
                                                                    ));
        return response()->json($element);         
    }

    public function GetListTipoInspeccion(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        $nIdEmpresa   = $request->nidempresa;
        $cNombreTipoInspeccion = $request->cnombre;

        $cNombreTipoInspeccion = ($cNombreTipoInspeccion == NULL) ? ($cNombreTipoInspeccion = '') : $cNombreTipoInspeccion;
                
        $arrayTipoInspeccion = DB::select('exec usp_TipoInspeccion_GetListTipoInspeccion ?, ?', 
                                                                    [$nIdEmpresa, $cNombreTipoInspeccion]);

        $arrayTipoInspeccion = ParametroController::arrayPaginator($arrayTipoInspeccion, $request);
        return ['arrayTipoInspeccion'=>$arrayTipoInspeccion];
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $objTpoInspecion = DB::select('exec usp_TipoInspeccion_DesactivaById ?', 
                                                            array(  $request->nIdTipoInspeccion
                                                                    ));
        return response()->json($objTpoInspecion);   
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $objTpoInspecion = DB::select('exec usp_TipoInspeccion_ActivaById ?', 
                                                            array(  $request->nIdTipoInspeccion
                                                                    ));
        return response()->json($objTpoInspecion);   
    }
    
    public function UpdTipoInspeccionById(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        $element = DB::select('exec usp_TipoInspeccion_UpdTipoInspeccionById ?, ?, ?, ?, ?, ?, ?, ?, ?', 
                                                            array($request->nIdEmpresa,
                                                                    $request->nIdTipoInspeccion,
                                                                    $request->cNombreTipoInspeccion,
                                                                    $request->nFlagAlmacen, 
                                                                    $request->nFlagAccesorio,
                                                                    $request->nFlagTestDrive,
                                                                    $request->nFlagSeccion,
                                                                    $request->nFlagFichaTecnica,
                                                                    Auth::user()->id
                                                                    ));
        return response()->json($element); 
    }

    public function GetFillTipoInspeccion(Request $request)
    {
        $nIdEmpresa   = $request->nidempresa;
        $cNombreTipoInspeccion = $request->cnombre;
        $variable   = $request->opcion;

        $cNombreTipoInspeccion = ($cNombreTipoInspeccion == NULL) ? ($cNombreTipoInspeccion = '') : $cNombreTipoInspeccion;

        $parametro = DB::select('exec usp_TipoInspeccion_GetListTipoInspeccion ?, ? ', 
                                                                        [$nIdEmpresa, $cNombreTipoInspeccion]);
        $data = [];
        if($variable == "0"){
            $data[0] = [
                'nIdTipoInspeccion'   => 0,
                'cNombreTipoInspeccion' =>'SELECCIONE',
            ];
        }
        foreach ($parametro as $key => $value) {
           $data[$key+1] =[
                'nIdTipoInspeccion'   => $value->nIdTipoInspeccion,
                'cNombreTipoInspeccion' => $value->cNombreTipoInspeccion,
            ];
        }
        return response()->json($data);
    }
}
