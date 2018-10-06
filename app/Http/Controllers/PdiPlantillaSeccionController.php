<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PdiPlantillaSeccionController extends Controller
{
    public function SetItemPlantilla(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        $element = DB::select('exec [usp_PlantillaInspeccion_SetPlantilla] ?, ?, ?, ?, ?, ?', 
                                                                [   $request->nIdEmpresa,
                                                                    $request->nIdTipoInspeccion,
                                                                    $request->nIdFlag, 
                                                                    $request->nIdSeccion,
                                                                    $request->nIdItem,
                                                                    Auth::user()->id
                                                                ]);
        return response()->json($element);         
    }

    public function GetListItems(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        $nIdEmpresa   = $request->nidempresa;
        $nIdTipoInspeccion = $request->nidtipoinspeccion;
        $nIdFlag = $request->nidflag;
        $nIdSeccion = $request->nidseccion;

        $nIdTipoInspeccion = ($nIdTipoInspeccion == NULL) ? ($nIdTipoInspeccion = 0) : $nIdTipoInspeccion;
        $nIdFlag = ($nIdFlag == NULL) ? ($nIdFlag = 0) : $nIdFlag;
        $nIdSeccion = ($nIdSeccion == NULL) ? ($nIdSeccion = 0) : $nIdSeccion;
                
        $arrayPlantilla = DB::select('exec [usp_PlantillaInspeccion_GetListItems] ?, ?, ?, ?', 
                                                                    [   $nIdEmpresa, 
                                                                        $nIdTipoInspeccion,
                                                                        $nIdFlag,
                                                                        $nIdSeccion
                                                                    ]);

        $arrayPlantilla = ParametroController::arrayPaginator($arrayPlantilla, $request);
        return ['arrayPlantilla'=>$arrayPlantilla];
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $objPlantilla = DB::select('exec [usp_PlantillaInspeccion_DesactivaById] ?', 
                                                            [  $request->nIdPlantillaInspeccionSeccionItem
                                                            ]);
        return response()->json($objPlantilla);   
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $objPlantilla = DB::select('exec [usp_PlantillaInspeccion_ActivaById] ?', 
                                                            [   $request->nIdPlantillaInspeccionSeccionItem
                                                            ]);
        return response()->json($objPlantilla);   
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

        $data = DB::select('exec [usp_TipoInspeccion_GetListTipoInspeccion] ?, ? ', 
                                                                        [   $nIdEmpresa, 
                                                                            $cNombreTipoInspeccion
                                                                        ]);
        return response()->json($data);
    }
}
