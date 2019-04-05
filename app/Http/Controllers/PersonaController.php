<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PersonaController extends Controller
{
    public function GetLstPersona(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa         =   $request->nidempresa;
        $nIdSucursal        =   $request->nidsucursal;
        $nTipoPersona       =   $request->ntipopersona;
        $cNroDocumento      =   $request->cnrodocumento;
        $cFiltroDescripcion =   $request->cfiltrodescripcion;
        $variable           =   $request->opcion;

        $cNroDocumento      =   ($cNroDocumento == NULL) ? ($cNroDocumento = ' ') : $cNroDocumento;
        $cFiltroDescripcion =   ($cFiltroDescripcion == NULL) ? ($cFiltroDescripcion = ' ') : $cFiltroDescripcion;
        $variable           =   ($variable == NULL) ? ($variable = 0) : $variable;

        $arrayPersona = DB::select('exec [usp_Persona_GetListPersona] ?, ?, ?, ?, ?, ?',
                                                                        [   $nIdEmpresa,
                                                                            $nIdSucursal,
                                                                            $nTipoPersona,
                                                                            $cNroDocumento,
                                                                            $cFiltroDescripcion,
                                                                            Auth::user()->id
                                                                        ]);

        if($variable == "0"){
            $arrayPersona = ParametroController::arrayPaginator($arrayPersona, $request);
        }
        return ['arrayPersona'=>$arrayPersona];
    }
}
