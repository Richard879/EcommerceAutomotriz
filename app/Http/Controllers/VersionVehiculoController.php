<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
//use App\VersionVehiculo;

class VersionVehiculoController extends Controller
{

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $versionvehiculo = DB::select('exec [usp_VersionVeh_SetVersion] ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                                [   $request->nIdEmpresa,
                                                                    $request->nIdProveedor,
                                                                    $request->nIdClase,
                                                                    $request->nIdSubClase,
                                                                    $request->nIdLinea,
                                                                    $request->nIdMarca,
                                                                    $request->nIdModelo,
                                                                    $request->cNombreComercial,
                                                                    Auth::user()->id
                                                                ]);
        return response()->json($versionvehiculo);
    }

    public function GetVersionVehiculo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa     = $request->nidempresa;
        $nIdProveedor   = $request->nidproveedor;
        $nIdClase       = $request->nidclase;
        $nIdSubClase    = $request->nidsubclase;
        $nIdLinea       = $request->nidlinea;
        $nIdMarca       = $request->nidmarca;
        $nIdModelo      = $request->nidmodelo;
        $cNombreComercial = $request->cnombrecomercial;
        
        $nIdClase = ($nIdClase == NULL) ? ($nIdClase = 0) : $nIdClase;
        $nIdSubClase = ($nIdSubClase == NULL) ? ($nIdSubClase = 0) : $nIdSubClase;
        $nIdLinea = ($nIdLinea == NULL) ? ($nIdLinea = 0) : $nIdLinea;
        $nIdMarca = ($nIdMarca == NULL) ? ($nIdMarca = 0) : $nIdMarca;
        $nIdModelo = ($nIdModelo == NULL) ? ($nIdModelo = 0) : $nIdModelo;
        $cNombreComercial = ($cNombreComercial == NULL) ? ($cNombreComercial = '') : $cNombreComercial;

        $arrayVersionVeh = DB::select('exec [usp_VersionVeh_GetVersionVehiculo] ?, ?, ?, ? ,? ,?, ?, ?',
                                                                            [   $nIdEmpresa,
                                                                                $nIdProveedor,
                                                                                $nIdClase,
                                                                                $nIdSubClase,
                                                                                $nIdLinea,
                                                                                $nIdMarca,
                                                                                $nIdModelo,
                                                                                $cNombreComercial
                                                                            ]);

        $arrayVersionVeh = ParametroController::arrayPaginator($arrayVersionVeh, $request);
        return ['arrayVersionVehiculo'=>$arrayVersionVeh];
    }

    public function UpdVersionVehiculoById(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $versionvehiculo = DB::select('exec [usp_VersionVeh_UpdVersionVehById] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                                [   $request->nIdVersionVeh,
                                                                    $request->nIdEmpresa,
                                                                    $request->nIdProveedor,
                                                                    $request->nIdClase,
                                                                    $request->nIdSubClase,
                                                                    $request->nIdLinea,
                                                                    $request->nIdMarca,
                                                                    $request->nIdModelo,
                                                                    $request->cNombreComercial,
                                                                    Auth::user()->id
                                                                ]);
        return response()->json($versionvehiculo);
    }

    public function GetLineasByProveedor(Request $request)
    {
        $nIdEmpresa = $request->nidempresa;
        $nIdProveedor = $request->nidproveedor;
        $cLineaNombre = $request->clineanombre;
        $variable   = $request->opcion;
        $cLineaNombre = ($cLineaNombre == NULL) ? ($cLineaNombre = ' ') : $cLineaNombre;
        $variable = ($variable == NULL) ? ($variable = 0) : $variable;

        $arrayLinea = DB::select('exec [usp_Par_GetLineaByProveedor] ?, ?, ?',
                                                            [   $nIdEmpresa,
                                                                $nIdProveedor,
                                                                $cLineaNombre
                                                            ]);
        if($variable == "0"){
            $arrayLinea = ParametroController::arrayPaginator($arrayLinea, $request);
        }
        return ['arrayLinea'=>$arrayLinea];
    }

    public function GetMarcaByLinea(Request $request)
    {
        $nIdLinea = $request->nidlinea;
        $variable   = $request->opcion;

        $variable = ($variable == NULL) ? ($variable = 0) : $variable;

        $arrayMarca = DB::select('exec [usp_Par_GetMarcaByLinea] ?',
                                                            [   $nIdLinea
                                                            ]);
        if($variable == "0"){
            $arrayMarca = ParametroController::arrayPaginator($arrayMarca, $request);
        }
        return ['arrayMarca'=>$arrayMarca];
    }

    public function GetModeloByMarca(Request $request)
    {
        $nIdLinea = $request->nidlinea;
        $nIdMarca = $request->nidmarca;
        $variable   = $request->opcion;

        $nIdLinea = ($nIdLinea == NULL) ? ($nIdLinea = 0) : $nIdLinea;
        $nIdMarca = ($nIdMarca == NULL) ? ($nIdMarca = 0) : $nIdMarca;
        $variable = ($variable == NULL) ? ($variable = 0) : $variable;

        $arrayModelo = DB::select('exec [usp_Par_GetModeloByMarca] ?, ?',
                                                    [   $nIdLinea,
                                                        $nIdMarca
                                                    ]);

        if($variable == "0"){
            $arrayModelo = ParametroController::arrayPaginator($arrayModelo, $request);
        }
        return ['arrayModelo'=>$arrayModelo];
    }

    public function GetSubLineaByLinea(Request $request)
    {
        $nIdLinea   = $request->nidlinea;
        $nIdModelo  = $request->nidmodelo;
        $variable   = $request->opcion;
        
        $nIdLinea = ($nIdLinea == NULL) ? ($nIdLinea = 0) : $nIdLinea;
        $variable = ($variable == NULL) ? ($variable = 0) : $variable;

        $arraySubLinea = DB::select('exec [usp_Par_GetSubLineaByLinea] ?, ?',
                                                    [   $nIdLinea,
                                                        $nIdModelo
                                                    ]);
        if($variable == "0"){
            $arraySubLinea = ParametroController::arrayPaginator($arraySubLinea, $request);
        }
        return ['arraySubLinea'=>$arraySubLinea];
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $versionvehiculo = DB::select('exec [usp_VersionVeh_DesactivaById] ?, ?',
                                                        [   $request->nIdVersionVeh,
                                                            Auth::user()->id
                                                        ]);
        return response()->json($versionvehiculo);
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $versionvehiculo = DB::select('exec [usp_VersionVeh_ActivaById] ?, ?',
                                                        [   $request->nIdVersionVeh,
                                                            Auth::user()->id
                                                        ]);
        return response()->json($versionvehiculo);
    }
}
