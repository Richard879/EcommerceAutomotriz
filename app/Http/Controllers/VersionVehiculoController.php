<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\VersionVehiculo;

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

        $nIdEmpresa = $request->nidempresa;
        $nIdProveedor = $request->nidproveedor;
        $nIdClase = $request->nidclase;
        $nIdSubClase = $request->nidsubclase;
        $nIdLinea = $request->nidlinea;
        $nIdMarca = $request->nidmarca;
        $nIdModelo = $request->nidmodelo;
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
        $cLineaNombre = "";

        $arrayLinea = DB::select('exec [usp_Par_GetLineaByProveedor] ?, ?, ?',
                                                            [   $nIdEmpresa, 
                                                                $nIdProveedor, 
                                                                $cLineaNombre
                                                            ]);

        $data = [];
        foreach ($arrayLinea as $key => $value) {
           $data[$key+1] =[
                'nIdPar'   => $value->nIdLinea,
                'cParNombre' => $value->cLineaNombre,
            ];
        }
        return response()->json($data);
    }

    public function GetMarcaByLinea(Request $request)
    {
        $nIdLinea = $request->nidlinea;

        $arrayMarca = DB::select('exec [usp_Par_GetMarcaByLinea] ?',
                                                    [   $nIdLinea
                                                    ]);

        $data = [];
        foreach ($arrayMarca as $key => $value) {
           $data[$key+1] =[
                'nIdPar'   => $value->nIdMarca,
                'cParNombre' => $value->cMarcaNombre,
            ];
        }
        return response()->json($data);
    }

    public function GetModeloByMarca(Request $request)
    {
        $nIdMarca = $request->nidmarca;

        $arrayModelo = DB::select('exec [usp_Par_GetModeloByMarca] ?',
                                                    [   $nIdMarca
                                                    ]);

        $data = [];
        /*$data[0] = [
            'nIdPar'   => 0,
            'cParNombre' =>'SELECCIONE',
        ];*/
        foreach ($arrayModelo as $key => $value) {
           $data[$key+1] =[
                'nIdPar'   => $value->nIdModelo,
                'cParNombre' => $value->cModeloNombre,
            ];
        }
        return response()->json($data);
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
