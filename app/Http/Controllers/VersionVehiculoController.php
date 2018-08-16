<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\VersionVehiculo;

class VersionVehiculoController extends Controller
{
    
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        $versionvehiculo = DB::select('exec usp_VersionVeh_SetVersion ?, ?, ?, ?, ?, ?, ?, ?, ?', 
                                                            array($request->nIdEmpresa,
                                                                    $request->nIdProveedor,
                                                                    $request->nIdClase,
                                                                    $request->nIdSubClase, 
                                                                    $request->nIdLinea,
                                                                    $request->nIdMarca,
                                                                    $request->nIdModelo,
                                                                    /*$request->nIdAnioFabricacion,
                                                                    $request->nIdAnioVersion,*/
                                                                    $request->cNombreComercial,
                                                                    Auth::user()->id
                                                                    ));
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
        
        $cNombreComercial = ($cNombreComercial == NULL) ? ($cNombreComercial = ' ') : $cNombreComercial;

        $arrayVersionVeh = DB::select('exec usp_VersionVeh_GetVersionVehiculo ?, ?, ?, ? ,? ,?, ?, ?', 
                                                                        array(  $nIdEmpresa,
                                                                                $nIdProveedor,
                                                                                $nIdClase,
                                                                                $nIdSubClase, 
                                                                                $nIdLinea,
                                                                                $nIdMarca,
                                                                                $nIdModelo,
                                                                                $cNombreComercial
                                                                                ));

        $arrayVersionVeh = $this->arrayPaginator($arrayVersionVeh, $request);
        return ['arrayVersionVehiculo'=>$arrayVersionVeh];   
    }

    public function arrayPaginator($array, $request)
    {
        $page = $request->page;
        $perPage = 10;
        $offset = ($page * $perPage) - $perPage;

        /*return new LengthAwarePaginator(array_slice($array, $offset, $perPage, true), count($array), $perPage, $page,
            ['path' => $request->url(), 'query' => $request->query()]);*/

        $array = new Collection($array);
        $result = $array->forPage($page, $perPage)->values()->all();
        return  new LengthAwarePaginator($result, $array->count(), $perPage,$page);
    }

    public function UpdVersionVehiculoById(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        $versionvehiculo = DB::select('exec usp_VersionVeh_UpdVersionVehById ?, ?, ?, ?, ?, ?, ?, ?, ?, ?', 
                                                            array(  $request->nIdVersionVeh,
                                                                    $request->nIdEmpresa,
                                                                    $request->nIdProveedor,
                                                                    $request->nIdClase,
                                                                    $request->nIdSubClase, 
                                                                    $request->nIdLinea,
                                                                    $request->nIdMarca,
                                                                    $request->nIdModelo,
                                                                    /*$request->nIdAnioFabricacion,
                                                                    $request->nIdAnioVersion,*/
                                                                    $request->cNombreComercial,
                                                                    Auth::user()->id
                                                                    ));
        return response()->json($versionvehiculo);                                               
    }

    public function GetLineasByProveedor(Request $request)
    {
        $nIdEmpresa = $request->nidempresa;
        $nIdProveedor = $request->nidproveedor;
        $cLineaNombre = "";

        $arrayLinea = DB::select('exec usp_Par_GetLineaByProveedor ?, ?, ?', 
                                                            array($nIdEmpresa, $nIdProveedor, $cLineaNombre));
                                                            
        $data = [];
        $data[0] = [
            'nIdPar'   => 0,
            'cParNombre' =>'SELECCIONE',
        ];
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

        $arrayMarca = DB::select('exec usp_Par_GetMarcaByLinea ?', 
                                                            array($nIdLinea));
                                                            
        $data = [];
        $data[0] = [
            'nIdPar'   => 0,
            'cParNombre' =>'SELECCIONE',
        ];
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

        $arrayModelo = DB::select('exec usp_Par_GetModeloByMarca ?', 
                                                            array($nIdMarca));
                                                            
        $data = [];
        $data[0] = [
            'nIdPar'   => 0,
            'cParNombre' =>'SELECCIONE',
        ];
        foreach ($arrayModelo as $key => $value) {
           $data[$key+1] =[
                'nIdPar'   => $value->nIdModelo,
                'cParNombre' => $value->cModeloNombre,
            ];
        }
        return response()->json($data);
    }

    public function desactivar (Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $versionvehiculo = DB::select('exec usp_VersionVeh_DesactivaById ?', 
                                                            array(  $request->nIdVersionVeh
                                                                    ));
        return response()->json($versionvehiculo);   
    }

    public function activar (Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $versionvehiculo = DB::select('exec usp_VersionVeh_ActivaById ?', 
                                                            array(  $request->nIdVersionVeh
                                                                    ));
        return response()->json($versionvehiculo);   
    }
}
