<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Parametro;

class ParametroController extends Controller
{
    public function GetParametroByGrupo(Request $request)
    {
        $nIdGrupoPar = $request->ngrupoparid;
        $variable   = $request->opcion;

        $parametro = DB::select('exec usp_Par_GetParametroByGrupo ?', array($nIdGrupoPar));
        $data = [];
        if($variable == "0"){
            $data[0] = [
                'nIdPar'   => 0,
                'cParNombre' =>'SELECCIONE',
            ];
        }
        foreach ($parametro as $key => $value) {
           $data[$key+1] =[
                'nIdPar'   => $value->nIdPar,
                'cParNombre' => $value->cParNombre,
            ];
        }
        return response()->json($data);
    }

    public function GetLstProveedor(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdGrupoPar = $request->nidgrupopar;
        $cNombreProveedor = $request->cnombreproveedor;
        $variable   = $request->opcion;

        $cNombreProveedor = ($cNombreProveedor == NULL) ? ($cNombreProveedor = ' ') : $cNombreProveedor;

        $parametro = DB::select('exec usp_Proveedor_GetLstProveedor ?, ?, ?',
                                                            array($nIdEmpresa, $nIdGrupoPar, $cNombreProveedor));

        $parametro = $this->arrayPaginator($parametro, $request);
        return ['arrayProveedor'=>$parametro];
    }

    public function GetLstProveedorSinPaginar(Request $request)
    {
        $nIdEmpresa = $request->nidempresa;
        $nIdGrupoPar = $request->nidgrupopar;
        $variable   = $request->opcion;

        $parametro = DB::select('exec usp_Proveedor_GetLstProveedor ?, ?', array($nIdEmpresa, $nIdGrupoPar));
        $data = [];
        if($variable == "0"){
            $data[0] = [
                'nIdPar'   => 0,
                'cParNombre' =>'SELECCIONE',
            ];
        }
        foreach ($parametro as $key => $value) {
           $data[$key+1] =[
                'nIdPar'   => $value->nIdPar,
                'cParNombre' => $value->cParNombre,
            ];
        }
        return response()->json($data);
    }

    public function GetLineasByProveedor(Request $request)
    {
        $nIdEmpresa = $request->nidempresa;
        $nIdProveedor = $request->nidproveedor;
        $cLineaNombre = $request->clineanombre;

        $cLineaNombre = ($cLineaNombre == NULL) ? ($cLineaNombre = ' ') : $cLineaNombre;

        $arrayLinea = DB::select('exec usp_Par_GetLineaByProveedor ?, ?, ?',
                                                            array($nIdEmpresa, $nIdProveedor, $cLineaNombre));

        $arrayLinea = $this->arrayPaginator($arrayLinea, $request);
        return ['arrayLinea'=>$arrayLinea];
    }

    public function GetMarcasByProveedor(Request $request)
    {
        $nIdEmpresa = $request->nidempresa;
        $nIdProveedor = $request->nidproveedor;
        $cMarcaNombre = $request->cmarcanombre;

        $cMarcaNombre = ($cMarcaNombre == NULL) ? ($cMarcaNombre = ' ') : $cMarcaNombre;

        $arrayMarca = DB::select('exec usp_Par_GetMarcaByProveedor ?, ?, ?',
                                                            array($nIdEmpresa, $nIdProveedor, $cMarcaNombre));

        $arrayMarca = $this->arrayPaginator($arrayMarca, $request);
        return ['arrayMarca'=>$arrayMarca];
    }

    public function GetModelosByProveedor(Request $request)
    {
        $nIdEmpresa = $request->nidempresa;
        $nIdProveedor = $request->nidproveedor;
        $cModeloNombre = $request->cmodelonombre;

        $cModeloNombre = ($cModeloNombre == NULL) ? ($cModeloNombre = ' ') : $cModeloNombre;

        $arrayModelo = DB::select('exec usp_Par_GetModeloByProveedor ?, ?, ?',
                                                            array($nIdEmpresa, $nIdProveedor, $cModeloNombre));

        $arrayModelo = $this->arrayPaginator($arrayModelo, $request);
        return ['arrayModelo'=>$arrayModelo];
    }

    public function arrayPaginator($array, $request)
    {
        $page = $request->page;
        $perPage = 10;
        $offset = ($page * $perPage) - $perPage;

        $array = new Collection($array);
        $result = $array->forPage($page, $perPage)->values()->all();
        return  new LengthAwarePaginator($result, $array->count(), $perPage,$page);
    }

    public function GetDocumentoNatural(Request $request)
    {
        $nIdGrupoPar = $request->ngrupoparid;
        $variable   = $request->opcion;

        $parametro = DB::select('exec usp_Par_GetDocumentoNatural ?', array($nIdGrupoPar));
        $data = [];
        if($variable == "0"){
            $data[0] = [
                'nIdPar'   => 0,
                'cParNombre' =>'SELECCIONE',
            ];
        }
        foreach ($parametro as $key => $value) {
           $data[$key+1] =[
                'nIdPar'   => $value->nIdPar,
                'cParNombre' => $value->cParNombre,
            ];
        }
        return response()->json($data);
    }

    public function GetDocumentoJuridica(Request $request)
    {
        $nIdGrupoPar = $request->ngrupoparid;
        $variable   = $request->opcion;

        $parametro = DB::select('exec usp_Par_GetDocumentoJuridica ?', array($nIdGrupoPar));
        $data = [];
        if($variable == "0"){
            $data[0] = [
                'nIdPar'   => 0,
                'cParNombre' =>'SELECCIONE',
            ];
        }
        foreach ($parametro as $key => $value) {
           $data[$key+1] =[
                'nIdPar'   => $value->nIdPar,
                'cParNombre' => $value->cParNombre,
            ];
        }
        return response()->json($data);
    }

    public function GetTipoByIdParametro(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdPar = $request->nidpar;
        $cTipoParametro = $request->ctipoparametro;
        $nIdTipoPar = $request->nidtipopar;

        $cTipoParametro = ($cTipoParametro == NULL) ? ($cTipoParametro = ' ') : $cTipoParametro;

        $tipoparametro = DB::select('exec usp_TipoPar_GetTipoByIdParametro ?, ?, ?',
                                                            [$nIdPar, $cTipoParametro, $nIdTipoPar]);

        return response()->json($tipoparametro);
    }
}
