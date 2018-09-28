<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Parametro;

class ParametroController extends Controller
{
    static function arrayPaginator($array, $request)
    {
        $page = $request->page;
        $perPage = 10;
        $offset = ($page * $perPage) - $perPage;

        $array = new Collection($array);
        $result = $array->forPage($page, $perPage)->values()->all();
        return  new LengthAwarePaginator($result, $array->count(), $perPage,$page);
    }

    public function GetParametroByGrupo(Request $request)
    {
        $nIdGrupoPar = $request->ngrupoparid;
        $variable   = $request->opcion;

        $parametro = DB::select('exec [usp_Par_GetParametroByGrupo] ?',
                                            [   $nIdGrupoPar
                                            ]);
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

        $parametro = DB::select('exec [usp_Proveedor_GetLstProveedor] ?, ?, ?',
                                                        [   $nIdEmpresa,
                                                            $nIdGrupoPar,
                                                            $cNombreProveedor
                                                        ]);

        $parametro = $this->arrayPaginator($parametro, $request);
        return ['arrayProveedor'=>$parametro];
    }

    public function GetLstProveedorSinPaginar(Request $request)
    {
        $nIdEmpresa = $request->nidempresa;
        $nIdGrupoPar = $request->nidgrupopar;
        $variable   = $request->opcion;

        $parametro = DB::select('exec [usp_Proveedor_GetLstProveedor] ?, ?',
                                                        [   $nIdEmpresa,
                                                            $nIdGrupoPar
                                                        ]);
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

        $arrayLinea = DB::select('exec [usp_Par_GetLineaByProveedor] ?, ?, ?',
                                                            [   $nIdEmpresa,
                                                                $nIdProveedor,
                                                                $cLineaNombre
                                                            ]);

        $arrayLinea = $this->arrayPaginator($arrayLinea, $request);
        return ['arrayLinea'=>$arrayLinea];
    }

    public function GetMarcasByProveedor(Request $request)
    {
        $nIdEmpresa = $request->nidempresa;
        $nIdProveedor = $request->nidproveedor;
        $cMarcaNombre = $request->cmarcanombre;
        $cMarcaNombre = ($cMarcaNombre == NULL) ? ($cMarcaNombre = ' ') : $cMarcaNombre;

        $arrayMarca = DB::select('exec [usp_Par_GetMarcaByProveedor] ?, ?, ?',
                                                            [   $nIdEmpresa,
                                                                $nIdProveedor,
                                                                $cMarcaNombre
                                                            ]);

        $arrayMarca = $this->arrayPaginator($arrayMarca, $request);
        return ['arrayMarca'=>$arrayMarca];
    }

    public function GetModelosByProveedor(Request $request)
    {
        $nIdEmpresa = $request->nidempresa;
        $nIdProveedor = $request->nidproveedor;
        $cModeloNombre = $request->cmodelonombre;
        $cModeloNombre = ($cModeloNombre == NULL) ? ($cModeloNombre = ' ') : $cModeloNombre;

        $arrayModelo = DB::select('exec [usp_Par_GetModeloByProveedor] ?, ?, ?',
                                                            [   $nIdEmpresa,
                                                                $nIdProveedor,
                                                                $cModeloNombre
                                                            ]);

        $arrayModelo = $this->arrayPaginator($arrayModelo, $request);
        return ['arrayModelo'=>$arrayModelo];
    }

    public function GetDocumentoNatural(Request $request)
    {
        $nIdGrupoPar = $request->ngrupoparid;
        $variable   = $request->opcion;

        $parametro = DB::select('exec [usp_Par_GetDocumentoNatural] ?',
                                                        [   $nIdGrupoPar
                                                        ]);
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

        $parametro = DB::select('exec [usp_Par_GetDocumentoJuridica] ?',
                                                        [   $nIdGrupoPar
                                                        ]);
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

        $tipoparametro = DB::select('exec [usp_TipoPar_GetTipoByIdParametro] ?, ?, ?',
                                                            [   $nIdPar,
                                                                $cTipoParametro,
                                                                $nIdTipoPar
                                                            ]);

        return response()->json($tipoparametro);
    }

    public function GetListParametroByGrupo(Request $request)
    {
        $nIdGrupoPar = $request->ngrupoparid;
        $variable   = $request->opcion;

        $arrayParametro = DB::select('exec [usp_Par_GetParametroByGrupo] ?',
                                                        [   $nIdGrupoPar
                                                        ]);
        return response()->json($data);
    }

    public function GetParametroById(Request $request)
    {
        $nIdPar = $request->nidpar;
        $nIdGrupoPar = $request->nidgrupopar;

        $data = DB::select('exec [usp_Par_GetParametroById] ?, ?',
                                                [   $nIdPar,
                                                    $nIdGrupoPar
                                                ]);

        return response()->json($data);
    }

    public function GetListParametroByParParent(Request $request)
    {
        $nIdPar = $request->nidpar;
        $nIdGrupoPar = $request->idgrupopar;

        $arrayParametro = DB::select('exec [usp_Par_GetParametroByParParent] ?, ?',
                                                                [   $nIdPar,
                                                                    $nIdGrupoPar
                                                                ]);

        $arrayParametro = $this->arrayPaginator($arrayParametro, $request);
        return ['arrayParametro'=>$arrayParametro];
    }

    public function GetListSucursalByEmpresa(Request $request)
    {
        $nIdEmpresa = $request->nidempresa;
        $variable   = $request->opcion;

        $parametro = DB::select('exec [usp_Par_GetListSucursalByEmpresa] ?',
                                            [   $nIdEmpresa
                                            ]);
        $data = [];
        if($variable == "0"){
            $data[0] = [
                'nIdPar'   => 0,
                'cParNombre' =>'SELECCIONE',
                'cParAbreviatura' =>'SELECCIONE',
            ];
        }
        foreach ($parametro as $key => $value) {
           $data[$key+1] =[
                'nIdPar'   => $value->nIdPar,
                'cParNombre' => $value->cParNombre,
                'cParAbreviatura' => $value->cParAbreviatura,
            ];
        }
        return response()->json($data);
    }

    public function GetListParametroByNombre(Request $request)
    {
        $nIdGrupoPar = $request->ngrupoparid;
        $cParNombre = $request->cparnombre;
        $variable   = $request->opcion;
        $cParNombre = ($cParNombre == NULL) ? ($cParNombre = '') : $cParNombre;

        $arrayParametro = DB::select('exec [usp_Par_GetListParametroByNombre] ?, ?',
                                                        [   $nIdGrupoPar,
                                                            $cParNombre
                                                        ]);
        $arrayParametro = $this->arrayPaginator($arrayParametro, $request);
        return ['arrayParametro'=>$arrayParametro];
    }

    public function GetParametroByNombre(Request $request)
    {
        $nIdGrupoPar = $request->ngrupoparid;
        $cParNombre = $request->cparnombre;
        $cParNombre = ($cParNombre == NULL) ? ($cParNombre = '') : $cParNombre;

        $data = DB::select('exec [usp_Par_GetListParametroByNombre] ?, ?',
                                                        [   $nIdGrupoPar,
                                                            $cParNombre
                                                        ]);
        return response()->json($data);
    }
}
