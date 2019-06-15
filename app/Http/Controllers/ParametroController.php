<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
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

        $nIdEmpresa         = $request->nidempresa;
        $nIdGrupoPar        = $request->nidgrupopar;
        $cNombreProveedor   = $request->cnombreproveedor;
        $nParTipo           = $request->npartipo;
        $variable           = $request->opcion;

        $cNombreProveedor = ($cNombreProveedor == NULL) ? ($cNombreProveedor = ' ') : $cNombreProveedor;
        $nParTipo = ($nParTipo == NULL) ? ($nParTipo = 1000) : $nParTipo;
        $variable = ($variable == NULL) ? ($variable = 0) : $variable;

        $arrayProveedor = DB::select('exec [usp_Proveedor_GetLstProveedor] ?, ?, ?, ?',
                                                        [   $nIdEmpresa,
                                                            $nIdGrupoPar,
                                                            $nParTipo,
                                                            $cNombreProveedor
                                                        ]);
        if($variable == "0"){
            $arrayProveedor = $this->arrayPaginator($arrayProveedor, $request);
        }
        return ['arrayProveedor'=>$arrayProveedor];
    }

    public function GetMarcasByProveedor(Request $request)
    {
        $nIdEmpresa = $request->nidempresa;
        $nIdProveedor = $request->nidproveedor;
        $cMarcaNombre = $request->cmarcanombre;
        $variable   = $request->opcion;
        $cMarcaNombre = ($cMarcaNombre == NULL) ? ($cMarcaNombre = ' ') : $cMarcaNombre;
        $variable = ($variable == NULL) ? ($variable = 0) : $variable;

        $arrayMarca = DB::select('exec [usp_Par_GetMarcaByProveedor] ?, ?, ?',
                                                            [   $nIdEmpresa,
                                                                $nIdProveedor,
                                                                $cMarcaNombre
                                                            ]);
        if($variable == "0"){
            $arrayMarca = $this->arrayPaginator($arrayMarca, $request);
        }
        return ['arrayMarca'=>$arrayMarca];
    }

    public function GetModelosByProveedor(Request $request)
    {
        $nIdEmpresa = $request->nidempresa;
        $nIdProveedor = $request->nidproveedor;
        $cModeloNombre = $request->cmodelonombre;
        $variable   = $request->opcion;
        $cModeloNombre = ($cModeloNombre == NULL) ? ($cModeloNombre = ' ') : $cModeloNombre;
        $variable = ($variable == NULL) ? ($variable = 0) : $variable;

        $arrayModelo = DB::select('exec [usp_Par_GetModeloByProveedor] ?, ?, ?',
                                                            [   $nIdEmpresa,
                                                                $nIdProveedor,
                                                                $cModeloNombre
                                                            ]);
        if($variable == "0"){
            $arrayModelo = $this->arrayPaginator($arrayModelo, $request);
        }
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

        $nIdPar         =   $request->nidpar;
        $cTipoParametro =   $request->ctipoparametro;
        $nIdTipoPar     =   $request->nidtipopar;
        $variable       =   $request->opcion;

        $cTipoParametro =   ($cTipoParametro == NULL) ? ($cTipoParametro = '') : $cTipoParametro;
        $nIdTipoPar     =   ($nIdTipoPar == NULL) ? ($nIdTipoPar = 0) : $nIdTipoPar;
        $variable       =   ($variable == NULL) ? ($variable = 0) : $variable;

        $arrayTipoParametro = DB::select('exec [usp_TipoPar_GetTipoByIdParametro] ?, ?, ?',
                                                            [   $nIdPar,
                                                                $cTipoParametro,
                                                                $nIdTipoPar
                                                            ]);

        if($variable == "0"){
            $arrayTipoParametro = $this->arrayPaginator($arrayTipoParametro, $request);
        }
        return ['arrayTipoParametro' => $arrayTipoParametro];
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

        $data = DB::select('exec [usp_Par_GetListSucursalByEmpresa] ?',
                                            [   $nIdEmpresa
                                            ]);
        return response()->json($data);
    }

    public function GetListParametroByNombre(Request $request)
    {
        $nIdGrupoPar = $request->ngrupoparid;
        $cParNombre = $request->cparnombre;
        $variable   = $request->opcion;
        $cParNombre = ($cParNombre == NULL) ? ($cParNombre = '') : $cParNombre;
        $variable = ($variable == NULL) ? ($variable = 0) : $variable;

        $arrayParametro = DB::select('exec [usp_Par_GetListParametroByNombre] ?, ?',
                                                        [   $nIdGrupoPar,
                                                            $cParNombre
                                                        ]);
        if($variable == "0"){
            $arrayParametro = $this->arrayPaginator($arrayParametro, $request);
        }
        return ['arrayParametro'=>$arrayParametro];
    }

    public function GetListParametroByGrupo(Request $request)
    {
        $nIdGrupoPar = $request->ngrupoparid;
        $cParNombre = $request->cparnombre;
        $nParTipo   = $request->npartipo;
        $variable   = $request->opcion;

        $nIdGrupoPar = ($nIdGrupoPar == NULL) ? ($nIdGrupoPar = 0) : $nIdGrupoPar;
        $cParNombre = ($cParNombre == NULL) ? ($cParNombre = '') : $cParNombre;
        $nParTipo = ($nParTipo == NULL) ? ($nParTipo = 0) : $nParTipo;
        $variable = ($variable == NULL) ? ($variable = 0) : $variable;

        $arrayParametro = DB::select('exec [usp_Par_GetListParametroByGrupo] ?, ?, ?',
                                            [   $nIdGrupoPar,
                                                $cParNombre,
                                                $nParTipo
                                            ]);

        if($variable == "0"){
            $arrayParametro = $this->arrayPaginator($arrayParametro, $request);
        }
        return ['arrayParametro'=>$arrayParametro];
    }

    public function GetListParametroByGrupoTodos(Request $request)
    {
        $nIdGrupoPar = $request->ngrupoparid;
        $cParNombre = $request->cparnombre;
        $nParTipo   = $request->npartipo;
        $variable   = $request->opcion;

        $nIdGrupoPar = ($nIdGrupoPar == NULL) ? ($nIdGrupoPar = 0) : $nIdGrupoPar;
        $cParNombre = ($cParNombre == NULL) ? ($cParNombre = '') : $cParNombre;
        $nParTipo = ($nParTipo == NULL) ? ($nParTipo = 0) : $nParTipo;
        $variable = ($variable == NULL) ? ($variable = 0) : $variable;

        $arrayParametro = DB::select('exec [usp_Par_GetListParametroByGrupoTodos] ?, ?, ?',
                                            [   $nIdGrupoPar,
                                                $cParNombre,
                                                $nParTipo
                                            ]);

        if($variable == "0"){
            $arrayParametro = $this->arrayPaginator($arrayParametro, $request);
        }
        return ['arrayParametro'=>$arrayParametro];
    }

    public function SetParametro(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $parametro = DB::select('exec [usp_Par_SetParametro] ?, ?, ?, ?, ?, ?',
                                                                [   $request->nIdGrupoPar,
                                                                    $request->cParJerarquia,
                                                                    $request->cParAbreviatura,
                                                                    $request->cParNombre,
                                                                    $request->nParTipo,
                                                                    Auth::user()->id
                                                                ]);
        return response()->json($parametro);
    }

    public function UpdParametroById(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $parametro = DB::select('exec [usp_Par_UpdParametroById] ?, ?, ?, ?, ?, ?, ?',
                                                                [   $request->nIdPar,
                                                                    $request->nIdGrupoPar,
                                                                    $request->cParJerarquia,
                                                                    $request->cParAbreviatura,
                                                                    $request->cParNombre,
                                                                    $request->nParTipo,
                                                                    Auth::user()->id
                                                                ]);
        return response()->json($parametro);
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $parametro = DB::select('exec [usp_Par_DesactivaById] ?, ?',
                                                        [   $request->nIdPar,
                                                            Auth::user()->id
                                                        ]);
        return response()->json($parametro);
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $parametro = DB::select('exec [usp_Par_ActivaById] ?, ?',
                                                        [   $request->nIdPar,
                                                            Auth::user()->id
                                                        ]);
        return response()->json($parametro);
    }

    public function GetLineaMarcaModelo(Request $request)
    {
        $nIdProveedor = $request->nidproveedor;
        $nIdLinea = $request->nidlinea;
        $nIdMarca = $request->nidmarca;
        $nIdModelo = $request->nidmodelo;
        $variable   = $request->opcion;

        $nIdModelo = ($nIdModelo == NULL) ? ($nIdModelo = 0) : $nIdModelo;
        $nIdMarca = ($nIdMarca == NULL) ? ($nIdMarca = 0) : $nIdMarca;
        $variable = ($variable == NULL) ? ($variable = 0) : $variable;

        $arrayLineaMarcaModelo = DB::select('exec [usp_Par_GetLineaMarcaModelo] ?, ?, ?, ?',
                                                            [   $nIdProveedor,
                                                                $nIdLinea,
                                                                $nIdMarca,
                                                                $nIdModelo
                                                            ]);
        if($variable == "0"){
            $arrayLineaMarcaModelo = $this->arrayPaginator($arrayLineaMarcaModelo, $request);
        }
        return ['arrayLineaMarcaModelo'=>$arrayLineaMarcaModelo];
    }

    public function SetLineaMarcaModelo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $objParParametroExt = DB::select('exec [usp_Par_SetLineaMarcaModelo] ?, ?, ?, ?, ?',
                                                            [   $request->nIdProveedor,
                                                                $request->nIdLinea,
                                                                $request->nIdMarca,
                                                                $request->nIdModelo,
                                                                Auth::user()->id
                                                            ]);
        return response()->json($objParParametroExt);
    }

    public function LineaMarcaModeloDesactiva(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $objParParametroExt = DB::select('exec [usp_Par_LineaMarcaModeloDesactiva] ?, ?, ?, ?, ?',
                                                        [   $request->nIdProveedor,
                                                            $request->nIdLinea,
                                                            $request->nIdMarca,
                                                            $request->nIdModelo,
                                                            Auth::user()->id
                                                        ]);
        return response()->json($objParParametroExt);
    }

    public function LineaMarcaModeloActiva(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $objParParametroExt = DB::select('exec [usp_Par_LineaMarcaModeloActiva] ?, ?, ?, ?, ?',
                                                        [   $request->nIdProveedor,
                                                            $request->nIdLinea,
                                                            $request->nIdMarca,
                                                            $request->nIdModelo,
                                                            Auth::user()->id
                                                        ]);
        return response()->json($objParParametroExt);
    }

    public function UpdTipoParametroById(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $cDatoParDescripcion = $request->cDatoParDescripcion;
        $nDatoParNumerico = $request->nDatoParNumerico;
        $fDatoParPorcentual = $request->fDatoParPorcentual;

        $cDatoParDescripcion = ($cDatoParDescripcion == NULL) ? ($cDatoParDescripcion = '') : $cDatoParDescripcion;
        $nDatoParNumerico = ($nDatoParNumerico == NULL) ? ($nDatoParNumerico = 0) : $nDatoParNumerico;
        $fDatoParPorcentual = ($fDatoParPorcentual == NULL) ? ($fDatoParPorcentual = 0) : $fDatoParPorcentual;

        $parametro = DB::select('exec [usp_TipoPar_UpdTipoParametroById] ?, ?, ?, ?, ?, ?, ?',
                                                        [   $request->nIdTipoPar,
                                                            $request->nIdPar,
                                                            $request->cTipoParametro,
                                                            $cDatoParDescripcion,
                                                            $nDatoParNumerico,
                                                            $fDatoParPorcentual,
                                                            Auth::user()->id
                                                        ]);
        return response()->json($parametro);
    }

    public function SetTipoParametro(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdPar                 = $request->nIdPar;
        $cTipoParametro         = $request->cTipoParametro;
        $cDatoParDescripcion    = $request->cDatoParDescripcion;
        $nDatoParNumerico       = $request->nDatoParNumerico;
        $fDatoParPorcentual     = $request->fDatoParPorcentual;

        $cDatoParDescripcion = ($cDatoParDescripcion == NULL) ? ($cDatoParDescripcion = '') : $cDatoParDescripcion;
        $nDatoParNumerico = ($nDatoParNumerico == NULL) ? ($nDatoParNumerico = 0) : $nDatoParNumerico;
        $fDatoParPorcentual = ($fDatoParPorcentual == NULL) ? ($fDatoParPorcentual = 0) : $fDatoParPorcentual;

        $parametro = DB::select('exec [usp_TipoPar_SetTipoParametro] ?, ?, ?, ?, ?, ?',
                                                        [   $request->nIdPar,
                                                            $request->cTipoParametro,
                                                            $cDatoParDescripcion,
                                                            $nDatoParNumerico,
                                                            $fDatoParPorcentual,
                                                            Auth::user()->id
                                                        ]);
        return response()->json($parametro);
    }
}
