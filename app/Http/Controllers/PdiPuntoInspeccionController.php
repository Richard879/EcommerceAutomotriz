<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PdiPuntoInspeccionController extends Controller
{
    public function SetPuntoInspeccion(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        $element = DB::select('exec [usp_PuntoInspeccion_SetPuntoInspeccion] ?, ?, ?, ?, ?, ?, ?', 
                                                                [   $request->nIdEmpresa,
                                                                    $request->nIdSucursal,
                                                                    $request->cNombrePuntoInspeccion,
                                                                    $request->nFlagTipoMovimiento, 
                                                                    $request->nFlagIngresoSucursal,
                                                                    $request->nFlagSalidaSucursal,
                                                                    Auth::user()->id
                                                                ]);
        return response()->json($element);         
    }

    public function GetListPuntoInspeccion(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        $nIdEmpresa  = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $cNombrePuntoInspeccion = $request->cnombre;

        $cNombrePuntoInspeccion = ($cNombrePuntoInspeccion == NULL) ? ($cNombrePuntoInspeccion = '') : $cNombrePuntoInspeccion;
                
        $arrayPuntoInspeccion = DB::select('exec [usp_PuntoInspeccion_GetListPuntoInspeccion] ?, ?, ?', 
                                                                                    [   $nIdEmpresa, 
                                                                                        $nIdSucursal,
                                                                                        $cNombrePuntoInspeccion
                                                                                    ]);

        $arrayPuntoInspeccion = ParametroController::arrayPaginator($arrayPuntoInspeccion, $request);
        return ['arrayPuntoInspeccion'=>$arrayPuntoInspeccion];
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
    
    public function UpdPuntoInspeccionById(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        $element = DB::select('exec [usp_PuntoInspeccion_UpdPuntoInspeccionById] ?, ?, ?, ?, ?, ?, ?, ?', 
                                                                [   $request->nIdPuntoInspeccion,
                                                                    $request->nIdEmpresa,
                                                                    $request->nIdSucursal,
                                                                    $request->cNombrePuntoInspeccion, 
                                                                    $request->nFlagTipoMovimiento,
                                                                    $request->nFlagIngresoSucursal,
                                                                    $request->nFlagSalidaSucursal,
                                                                    Auth::user()->id
                                                                ]);
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
